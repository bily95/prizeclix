<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Lib\ProxyCheck;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class CheckStatus
{


    public function handle($request, Closure $next)
    {

        $userIp = getUserIP();

        if (
            auth()->check()
            && session('clean_ip') != $userIp
            && session('bad_ip') != $userIp
            && SETTING['detect_using_vpn']
        ) {

            $user = auth()->user();
            $proxyCheckRequest = ProxyCheck::check(
                $userIp,
                $this->proxyOptions()
            );

            if ($proxyCheckRequest['block'] == 'yes') {
                session(['bad_ip' => $userIp]);
                if (SETTING['auto_ban_using_vpn']) {
                    User::where('id', $user->id)
                        ->where('role', '!=', 1)
                        ->update(['status' => 0]);
                }
            } else
                session(['clean_ip' => $userIp]);
        }

        if (session('bad_ip') == $userIp)
            abort(403, 'We are sorry, Using VPS is blocked');

        if (Str::contains(SETTING['blocked_country'], getIpInfo()['code'])) {
            abort(403, 'We are sorry, your country is blocked');
        }

        if (Auth::check()) {
            $user = auth()->user();
            if ($user->status && $user->ev && $user->tv) {
                User::where('id', $user->id)->update(['updated_at' => now()]);
                return $next($request);
            } else {
                return redirect()->route('user.authorization');
            }
        }

        return $next($request);
    }

    protected function proxyOptions()
    {
        return array(
            'API_KEY' => SETTING['proxycheck_io_api'],
            // Your API Key.
            'ASN_DATA' => 1,
            // Enable ASN data response.
            'DAY_RESTRICTOR' => 7,
            // Restrict checking to proxies seen in the past # of days.
            'VPN_DETECTION' => 1,
            // Check for both VPN's and Proxies instead of just Proxies.
            'RISK_DATA' => 1,
            // 0 = Off, 1 = Risk Score (0-100), 2 = Risk Score & Attack History.
            'INF_ENGINE' => 1,
            // Enable or disable the real-time inference engine.
            'TLS_SECURITY' => 0,
            // Enable or disable transport security (TLS).
            'QUERY_TAGGING' => 1,
            // Enable or disable query tagging.
            'CUSTOM_TAG' => '',
            // Specify a custom query tag instead of the default (Domain+Page).
            // 'BLOCKED_COUNTRIES' => array('Wakanda', 'CN'), // Specify an array of countries or isocodes to be blocked.
            // 'ALLOWED_COUNTRIES' => array('Azeroth', 'US') // Specify an array of countries or isocodes to be allowed.
        );
    }
}
