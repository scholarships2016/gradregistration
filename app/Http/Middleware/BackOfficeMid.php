<?php

namespace App\Http\Middleware;

use App\Utils\Util;
use Closure;

class BackOfficeMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {

        $userType = session('user_type');
        if (empty($userType)) {
            //Send To Error Page
        }

        if (!empty($permission)) {
            $userPermission = session('user_permission');
            if (in_array($permission, $userPermission)) {
                return $next($request);
            }
        }

        if ($userType->user_type == 'Admin') {
            return $next($request);
        }

        session()->flash('errorMsg', Util::UNABLE_TO_ACCESS);
        return redirect()->route('admin.backoffice.showToDoListPage');
    }
}
