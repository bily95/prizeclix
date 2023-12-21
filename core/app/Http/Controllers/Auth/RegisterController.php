<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Helper\Captcha;
use Illuminate\Http\Request;
use App\Http\Traits\AuthTrait;
use App\Models\User\UserProfile;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, AuthTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('regStatus')->except('registrationNotAllowed');
    }

    public function showRegistrationForm()
    {
        return view(SETTING['site_theme'] . 'auth.register', [
            'enabledCaptcha' => SETTING['en_cap_register'],
            'captcha' => (new Captcha())->create(),
        ]);
    }

    public function register(Request $request)
    {
        // check user captcha if admin enabled it
        if (SETTING['en_cap_register']) {
            if (!(new Captcha())->check($request->toArray()))
                return redirect()->route('user.register')
                    ->withInput()
                    ->withNotify([['error', 'Invalid captcha']]);
        }

        // validated user form 
        $valid = $this->validator($request->all());
        if (count($valid->errors()) > 0)
            return back()->withErrors($valid->errors())
                ->withInput();


        //create new user 
        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        $password_validation = Password::min(6);
        if (GENERAL_SETTING['secure_password']) {
            $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $validate = Validator::make($data, [
            'email' => 'required|string|email|max:90|unique:users',
            'password' => ['required', 'confirmed', $password_validation],
            'username' => 'required|alpha_num|unique:users|min:6',
        ]);
 
        return $validate;
    }


    protected function create($request)
    {

        $balance = 0;

        $referBy = session()->get('reference');

        if ($referBy) {
            $referUser = User::where('token_id', $referBy)->first();
            if ($referUser && boolval($referUser->ref_bounce)) {
                $balance = SETTING['reg_ref_bounce'];
            }
        } else {
            $referUser = null;
        }
        //User Create
        $user = User::create([
            'token_id' => generateToken(),
            'username' => $request->username,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'timezone' => config('app.timezone'),
            'ref_by' => $referUser ? $referUser->id : 0,
            'ev' => GENERAL_SETTING['ev'] ? 0 : 1,
            'sv' => GENERAL_SETTING['sv'] ? 0 : 1,
            'balance' => $balance,
        ]);

        UserProfile::create([
            'user_id' => $user->id,
        ]);

        if ($balance > 0){
            //save transactions
            \App\Models\Transaction::store([
                'user' => $user,
                'amount' => SETTING['reg_ref_bounce'],
                'from' => 'REFERRAL_BOUNCE',
                'source_id' => $user->id,
                'details' => 'Signup bonus',
            ]);
        }


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = urlPath('moder.users.detail', $user->id);
        $adminNotification->save();

        $this->loginLog($user);

        return $user;
    }

    public function registered()
    {
        return redirect()->route('user.home');
    }

    public function checkUser(Request $request)
    {
        $exist['data'] = null;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = User::where('email', $request->email)->first();
            $exist['type'] = 'email';
        }

        if ($request->username) {
            $exist['data'] = User::where('username', $request->username)->first();
            $exist['type'] = 'username';
        }

        return response($exist);
    }
}
