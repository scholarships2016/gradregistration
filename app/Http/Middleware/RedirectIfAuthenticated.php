<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

    public function handle($request, Closure $next) {
         if (Auth::guard()->check()) {
            return redirect('/');
        }
 
         if (Auth::guard('web')->check()) {
            return redirect('/');
        }
        
         if (Auth::guard('admins')->check()) {
            return redirect('/');
        }
        return $next($request);
    }

}
