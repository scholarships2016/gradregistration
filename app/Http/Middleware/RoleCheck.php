<?php

namespace App\Http\Middleware;

use App\Utils\Util;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        $pathStr = $request->path();
        $pathArr = explode("/", $pathStr);
        $moduleStr = empty($pathArr[0]) ? null : $pathArr[0];
        $subModuleStr = empty($pathArr[1]) ? null : $pathArr[1];
        $actionStr = empty($pathArr[2]) ? null : $pathArr[2];

        $user = Session::get('user');
        $role = Session::get('role');


        $roleNameEng = $role->role_name_eng;
        if (strcmp($roleNameEng, Util::ROLE_ROOT) == 0) {
            return $next($request);
        }

//        $moduleAuths = Auth::user()->moduleAuthorities;
        $moduleAuths = Session::get('moduleAuths');
//        dd($moduleAuths);
//        return;

        if (!empty($moduleAuths)) {
            try {
                foreach ($moduleAuths as $mAuth) {
//                    dd($mAuth);
//                    return;
                    $pos = strpos($pathStr, $mAuth);
                    if ($pos !== false) {
                        return $next($request);
                    }
                }

            } catch (\Exception $ex) {
                echo $ex->getMessage();
            }
        }

        //ToDo Something [In case of No Authorize]

        session()->flash('errorMsg',Util::UNABLE_TO_ACCESS);
        return redirect('/home');
    }
}
