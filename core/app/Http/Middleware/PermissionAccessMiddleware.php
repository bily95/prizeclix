<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $permissions = explode('|', $permission);

        if (self::checkPermission($permissions)) {
            return $next($request);
        }

        return abort(503);
    }

    // return user permission if could access
    public static function checkPermission($permissions)
    {
        $userAccess = self::getUserPermission();
        foreach ($permissions as $value) {
            if ($value == $userAccess) {
                return true;
            }
        }
        return false;
    }

    // check user permission type
   public static function getUserPermission()
    {
        switch (auth()->user()->role) {
            case 1:
                return 'admin';
                break;
            default:
                return 'user';
                break;
        }
    }
}
