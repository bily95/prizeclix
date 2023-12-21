<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    use AuthTrait;

    /**
     * ForgotPasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return Factory|View
     */
    public function showLinkRequestForm()
    {
        $pageTitle = "Forgot Password";
        return view(SETTING['site_theme'] . 'auth.passwords.email', compact('pageTitle'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function sendResetCodeEmail(Request $request)
    {
        $validate = $this->verify($request);

        $request->validate($validate->rule, $validate->message);

        $user = User::where($request->type, $request->value)->first();

        if (!$user) {
            $notify[] = ['error', 'User not found.'];
            return back()->withNotify($notify);
        }
        $this->sendVerify($user);
        $pageTitle = 'Account Recovery';
        $email = $user->email;
        session()->put('pass_res_mail', $email);
        $notify[] = ['success', 'Password reset email sent successfully'];
        return redirect()->route('user.password.code.verify')->withNotify($notify);
    }

    public function codeVerify()
    {
        $pageTitle = 'Account Recovery';
        $email = session()->get('pass_res_mail');
        if (!$email) {
            $notify[] = ['error', 'Oops! session expired'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        return view(SETTING['site_theme'] . 'auth.passwords.code_verify', compact('pageTitle', 'email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required'
        ]);
        $code = str_replace(' ', '', $request->code);

        if (PasswordReset::where('token', $code)->where('email', $request->email)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        $notify[] = ['success', 'You can change your password.'];
        session()->flash('fpass_email', $request->email);
        return redirect()->route('user.password.reset', $code)->withNotify($notify);
    }

}
