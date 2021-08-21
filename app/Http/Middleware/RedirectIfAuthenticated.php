<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::guard($guard)->check()) {

            switch ($guard) {
                case 'admin-web':
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                    
                case 'customer-web':
                    return redirect(RouteServiceProvider::CUSTOMER_HOME);
                
                default:
                    return redirect(RouteServiceProvider::HOME);
            }
        }
        //dd($next($request));
        return $next($request);
    }
}