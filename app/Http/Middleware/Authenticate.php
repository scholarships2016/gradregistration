<?php

namespace App\Http\Middleware;

use Closure;
//Auth Facade
use Auth;

class Authenticate {

    public function handle($request, Closure $next) {

        if (!Auth::guard()->check() && !Auth::guard('admins')->check()) {
            return redirect('/login');
        }

        return $next($request);
    }

}
