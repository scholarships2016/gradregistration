<?php

namespace App\Http\Middleware;

use Closure;
//Auth Facade
use Auth;

class Authenticate {

    public function handle($request, Closure $next) {

           if ( Auth::check() )
        {
            return $next($request);
        }

        return redirect('/login');

    }

}
