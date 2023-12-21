<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Helper\Captcha;
use Illuminate\Http\Request;
use App\Http\Traits\AuthTrait;
use App\Models\User\UserProfile;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, AuthTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function showLoginForm()
    {

        return view( SETTING['site_theme'] . 'auth.login', [
            'enabledCaptcha' => SETTING['en_cap_login'],
            'captcha' => (new Captcha())->create(),
        ]);
    }

    public function login(Request $request)
    {
        if (SETTING['en_cap_login']) {
            if (!(new Captcha())->check($request->toArray()))
            {
                return redirect()->route('user.login')
                    ->withNotify([['error', 'Invalid captcha']]);
            }
        }

        $this->validateLogin($request);
        

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
    
        
        $username = $request->input('username');
        $password = $request->input('password');
        
        if (filter_var($username, FILTER_VALIDATE_EMAIL))
        {
            // email login
            if(Auth::attempt(['email'=>$username, 'password'=>$password], $request->remember))
            {
                $this->loginLog(auth()->user());
                return $this->sendLoginResponse($request);
            }
            
        }
        else{
            // username login
            $user = User::where('username', $username)->whereNull('google_id')->first();
            if($user){
                if(Hash::check(trim($password), $user->password)){
                    if ($user->status == 0 && $user->role != 1) {
                        $this->guard()->logout();
                        $notify[] = ['error', 'Your account has been banned.'];
                        return redirect()->route('user.login')->withNotify($notify);
                    }
                    Auth::login($user);
                    $this->loginLog($user);
                    return $this->sendLoginResponse($request);
                }
            }
        }
        
        
        // if ($this->attemptLogin($request)) {
        //     return $this->sendLoginResponse($request);
        // }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $validation_rule = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];
        
        $request->validate($validation_rule);
    }

    public function username()
    {
        return $this->username;
    }

    public function logout()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        $notify[] = ['success', 'You have been logged out.'];
        return redirect()->route('user.login')->withNotify($notify);
    }


    public function authenticated(Request $request, $user)
    {
        if ($user->status == 0) {
            $this->guard()->logout();
            $notify[] = ['error', 'Your account has been banned.'];
            return redirect()->route('user.login')->withNotify($notify);
        }


        $user = auth()->user();
        $user->tv = $user->ts == 1 ? 0 : 1;
        $user->save();

        return redirect()->route('user.home');
    }

    // google authentication
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleLoginCallback(Request $request)
    {
        try {

            $user = Socialite::driver('google')->user();
            $google_avatar = $user->avatar;


            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
            
                UserProfile::where('user_id', $finduser->id)->update([
                    'image'=>$google_avatar
                ]);
                
                if ($finduser->status == 0) {
                    $this->guard()->logout();
                    $notify[] = ['error', 'Your account has been banned.'];
                    return redirect()->route('user.login')->withNotify($notify);
                }

                Auth::login($finduser);
                $this->loginLog($finduser);
                    
                return redirect()->intended('earn');
            } else {
                
                                
                if(GENERAL_SETTING['registration'] == "0"){
                    $notify[] = ['error', 'Registration will open soon.'];
                    return redirect('/')->withNotify($notify);
                }
                
                
                // check if email already exists
                
                if(User::where('email', $user->email)->exists()){
                    $notify[] = ['error', 'Email already exists.'];
                    return redirect()->route('user.register')->withNotify($notify);
                }

                $balance = 0;
                $referBy = session()->get('reference');
                if ($referBy) {
                    $referUser = User::where('username', $referBy)->first();
                    if ($referUser && boolval($referUser->ref_bounce)) {
                        $balance = SETTING['reg_ref_bounce'];
                    }
                } else {
                    $referUser = null;
                }

                $name = explode(' ', $user->name);

                $newUser = User::create([
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('123456dummy'),
                    'token_id' => generateToken(),
                    'timezone' => config('app.timezone'),
                    'ref_by' => $referUser ? $referUser->id : 0,
                    'ev' => 1,
                    'balance' => $balance,
                    'sv' => GENERAL_SETTING['sv'] ? 0 : 1,
                    'firstname' => isset($name[0]) ? $name[0] : 'New',
                    'lastname' => isset($name[1]) ? $name[1] : 'User',
                    'username' => str_replace(' ', '', $user->name),
                ]);

                if ($referUser && boolval($referUser->ref_bounce) && SETTING['reg_ref_bounce'] > 0){
                    //save transactions
                    \App\Models\Transaction::store([
                        'user' => $user,
                        'amount' => SETTING['reg_ref_bounce'],
                        'from' => 'REFERRAL_BOUNCE',
                        'source_id' => $user->id,
                        'details' => 'Signup bonus',
                    ]);
                }

                UserProfile::create([
                    'user_id' => $newUser->id,
                    'image'=> $google_avatar
                ]);
        
        
                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $newUser->id;
                $adminNotification->title = 'New member registered';
                $adminNotification->click_url = urlPath('moder.users.detail', $newUser->id);
                $adminNotification->save();

                Auth::login($newUser);
                $this->loginLog($newUser);

                return redirect()->intended('earn');
            }
        } catch (\Exception $e) {
            
            $notify[] = ['error', $e->getMessage()];
             return redirect('/')->withNotify($notify);
        }
    }
}
