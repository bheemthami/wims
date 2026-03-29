<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        // default guard is web, but you can specify other guards like admin, api, etc.
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::HOME);
        // }

        // Sentinel check for authentication

        if (Sentinel::check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
