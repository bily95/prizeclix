<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Rules\FileTypeValidate;
use Illuminate\Validation\Rule;
use App\Lib\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Charts\UserEarningsChart;
use App\Models\User\UserProfile;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{


  public function index($tab = '')
  {

    $user = User::with(['withdrawals', 'offers', 'commissions'])
      ->where('id', auth()->id())->first();

    $level = UserProfile::level(auth()->id());

    $referredBy = User::select('username')->where('id', $user->ref_by)->first();

    if (!empty($tab)) {

      abort_if(!in_array($tab, ['update', 'password', 'twofactor', 'account']), 404);
      return $this->$tab();
    }

    $earningChart = (new UserEarningsChart())->chart();

    $totalWithdrawals = $user->withdrawals->sum('amount');

    $completedOffers = $user->offers->where('is_paid', true)->count();

    $pendingOffers = $user->offers->where('is_paid', false)->count();

    return view(
      SETTING['site_theme'] . 'profile.index',
      compact(
        'user',
        'level',
        'referredBy',
        'earningChart',
        'totalWithdrawals',
        'completedOffers',
        'pendingOffers'
      )
    );
  }

  protected function update()
  {
    $user = User::with(['profile'])
      ->where('id', auth()->id())->first();

    $referredBy = User::select('username')->where('id', $user->ref_by)->first();

    $userAddress = json_decode($user->profile->address, true);

    return view(
      SETTING['site_theme'] . 'profile.index',
      compact('user', 'referredBy', 'userAddress')
    );
  }

  public function submitProfile(Request $request)
  {
    $request->validate([

      'firstname' => ['bail', 'nullable', 'string', 'min:1', 'max:50'],
      'lastname' => ['bail', 'nullable', 'string', 'min:1', 'max:50'],
      'mobile' => ['bail', 'nullable', 'numeric'],
      'address.address1' =>  ['bail', 'nullable', 'string', 'min:1', 'max:50'],
      'address.city' =>  ['bail', 'nullable', 'string', 'min:1', 'max:50'],
      'address.state' =>  ['bail', 'nullable', 'string', 'min:1', 'max:50'],
      'address.zip' =>  ['bail', 'nullable', 'string', 'min:1', 'max:50'],
      'address.country' =>  ['bail', 'nullable', 'string', 'min:1', 'max:50'],

    ]);

    $user = Auth::user();

    $user->update([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'mobile' => $request->mobile,
    ]);

    $user->profile->update([
      'address' => json_encode($request->address),
    ]);


    if ($request->hasFile('image')) {

      if (!empty($user->google_id)) {
        return back()->withNotify([['error', 'changing image is not allowed']]);
      }

      $request->validate(['image' => [
        'bail', 'image', new FileTypeValidate(['png', 'jpg'])
      ]]);

      $path = imagePath()['users']['path'];
      $size = imagePath()['users']['size'];

      try {
        $filename = null;

        $filename = uploadImage($request->image, $path, $size, $user->profile->image);

        $user->profile->update(['image' => $filename]);
      } catch (\Exception $exp) {

        $notify[] = ['error', 'Image could not be uploaded.'];

        return back()->withNotify($notify);
      }
    }

    $notify[] = ['success', 'Profile updated'];

    return back()->withNotify($notify);
  }

  protected function password()
  {
    $user = auth()->user();

    $referredBy = User::select('username')->where('id', $user->ref_by)->first();

    return view(
      SETTING['site_theme'] . 'profile.index',
      compact('user', 'referredBy')
    );
  }

  public function submitPassword(Request $request)
  {

    $password_validation = Password::min(6);
    
    if (GENERAL_SETTING['secure_password']) {
      $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
    }

    $this->validate($request, [
      'current_password' => 'required',
      'password' => ['required', 'confirmed', $password_validation]
    ]);


    try {
      $user = auth()->user();
      if (Hash::check($request->current_password, $user->password)) {
        $password = Hash::make($request->password);
        $user->password = $password;
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return back()->withNotify($notify);
      } else {
        $notify[] = ['error', 'Passwords don\'t match!'];
        return back()->withNotify($notify);
      }
    } catch (\PDOException $e) {
      $notify[] = ['error', $e->getMessage()];
      return back()->withNotify($notify);
    }
  }

  protected function twofactor()
  {
    $user = auth()->user();

    $referredBy = User::select('username')->where('id', $user->ref_by)->first();


    $ga = new GoogleAuthenticator();

    $secret = $ga->createSecret();
    
    session()->put("twoFactore", $secret);

    $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . SETTING['siteName'], $secret);

    return view(
      SETTING['site_theme'] . 'profile.index',
      compact('user', 'referredBy', 'secret', 'qrCodeUrl')
    );
  }


  public function create2fa(Request $request)
  {
    $user = auth()->user();

    $request->validate([
      'key' => 'required|string|min:1|max:191',
      'code' => 'required|string|min:4|max:6',
    ]);
    
    $code = $request->code;

    $key = session()->get('twoFactore');

    $response = verifyG2fa($user, $code , $key);
    if ($response) {
      $user->tsc = $key;
      $user->ts = 1;
      $user->save();
      $userAgent = getIpInfo();
      $osBrowser = osBrowser();
      notify($user, '2FA_ENABLE', [
        'operating_system' => @$osBrowser['os_platform'],
        'browser' => @$osBrowser['browser'],
        'ip' => @$userAgent['ip'],
        'time' => @$userAgent['time']
      ]);
      $notify[] = ['success', 'Google authenticator enabled successfully'];
      return back()->withNotify($notify);
    } else {
      $notify[] = ['error', 'Wrong verification code'];
      return back()->withNotify($notify);
    }
  }


  public function disable2fa(Request $request)
  {
    $this->validate($request, [
      'code' => 'required',
    ]);

    $user = auth()->user();
    $response = verifyG2fa($user, $request->code);
    if ($response) {
      $user->tsc = null;
      $user->ts = 0;
      $user->save();
      $userAgent = getIpInfo();
      $osBrowser = osBrowser();
      notify($user, '2FA_DISABLE', [
        'operating_system' => @$osBrowser['os_platform'],
        'browser' => @$osBrowser['browser'],
        'ip' => @$userAgent['ip'],
        'time' => @$userAgent['time']
      ]);
      $notify[] = ['success', 'Two factor authenticator disable successfully'];
    } else {
      $notify[] = ['error', 'Wrong verification code'];
    }
    return back()->withNotify($notify);
  }


  protected function account()
  {
    $user = auth()->user();

    $referredBy = User::select('username')->where('id', $user->ref_by)->first();

    return view(
      SETTING['site_theme'] . 'profile.index',
      compact('user', 'referredBy')
    );
  }

  public function submitAccount(Request $request)
  {

    $user = auth()->user();
    
    $request->validate([
      'username' => ['required', 'string', 'min:5', 'max:50', Rule::unique('users')->ignore($user->id)],
      'isPublic' => ['in:on,off'],
    ]);

    $user->update(['username'=> $request->username]);
    $user->profile->update(['isPublic' => boolval($request->isPublic)]);

    return back()->withNotify([['success', 'The setting updated']]);

  }
}
