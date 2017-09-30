<?php

namespace App\Http\Middleware;

use Closure;
//Auth Facade
use Auth;

class Authenticate {

    public function handle($request, Closure $next) {

        if (!Auth::guard()->check() && !Auth::guard('admins')->check()) {
          if (Request::is('/admin/*'))
          {
            return redirect('/admin/login');
          }else{
            return redirect('/login');
          }

        }

        return $next($request);
    }

}
