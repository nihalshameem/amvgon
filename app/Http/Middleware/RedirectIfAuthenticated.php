<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        // if ($guard == "writer" && Auth::guard($guard)->check()) {
        //     return redirect('/writer');
        // }
        if ($guard == "customer" && Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
