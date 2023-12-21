<?php

namespace App\Http\Middleware;

use App\Models\GeneralSetting;
use Closure;

class AllowRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (GeneralSetting::first()->registration == 0) {
            session()->flash('notify', ['error' => 'invalid']);
            $notify[] = ['error', 'Registrations will reopen soon, stay tuned!.'];
            return back()->withNotify($notify);
        }
        return $next($request);
    }
}
