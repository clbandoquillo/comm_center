<?php

namespace App\Http\Middleware;

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
            if(checkIfBeadle($request->user()->student_code)){
                return redirect()->route('studentDashboard');
            }

            $route = routeAuthChecker($request->user()->sysetem_role_id);
            return redirect()->route($route['route']);
        }

        return $next($request);
    }
}
