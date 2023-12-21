<?php


namespace App\Http\Traits;


use App\Models\PasswordReset;
use App\Models\UserLogin;

trait AuthTrait
{

    /**
     * @param $user
     */
    public function loginLog($user)
    {
        $ip = getUserIP();
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();
        if ($exist) {
            $userLogin->longitude = $exist->longitude;
            $userLogin->latitude = $exist->latitude;
            $userLogin->city = $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country = $exist->country;
        } else {
            $info = getIpInfo();
            $userLogin->longitude = @$info['long'];
            $userLogin->latitude = @$info['lat'];
            $userLogin->city = @$info['city'];
            $userLogin->country_code = @$info['code'];
            $userLogin->country = @$info['country'];
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip = $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();
    }

    /**
     * @param $request
     * @param bool $json
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function verify($request, $json = false)
    {
        $verify = [];
        if ($request->type == 'email') {
            $verify['rule'] = [
                'value' => 'required|email'
            ];
            $verify['message'] = [
                'value.required' => 'Email field is required',
                'value.email' => 'Email must be a valid email'
            ];
        } elseif ($request->type == 'username') {
            $verify['rule'] = [
                'value' => 'required'
            ];
            $verify['message'] = ['value.required' => 'Username field is required'];
        } else {
            if ($json) {
                return response()->json($this->sendResponse(['error' => ['Invalid selection']]));
            } else {
                $notify[] = ['error', 'Invalid selection'];
                return back()->withNotify($notify);
            }

        }

        return (object)$verify;

    }

    /**
     * @param array $message
     * @param int $code
     * @param string $status
     * @param array $data
     * @return array
     */
    protected function sendResponse($message = [], $code = 200, $status = 'ok', $data = [])
    {
        return [
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }

    /**
     * @param $user
     */
    public function sendVerify($user)
    {
        PasswordReset::where('email', $user->email)->delete();
        $code = verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();
        sendEmail($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ]);
    }

}
