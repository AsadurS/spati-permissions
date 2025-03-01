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
       $redirectPath = ($guard ==='admin'?"admin.dashboard":"user.dashboard");
        if (Auth::guard($guard)->check()) {
            return redirect($redirectPath);
        }
        if(!Auth::guard($guard)->check() && $guard ==='admin' )
        {
          return redirect()->route('admin.login'); 
        }

        return $next($request);
    }
}
