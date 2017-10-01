<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
//Auth Facade
use Auth;

class Authenticate {

    public function handle($request, Closure $next) {

        if (!Auth::guard()->check() && !Auth::guard('admins')->check()) {

        if ($request->is('admin/*')) {
            return redirect('/admin/login');
          }else{
            return redirect('/login');
          }

        }

        return $next($request);
    }

}
