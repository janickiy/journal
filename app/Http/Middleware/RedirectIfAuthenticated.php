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

            if (isset(Auth::user()->role->name) && Auth::user()->role->name == 'applicant')
                $redirectTo = 'applicant';
            else if(isset(Auth::user()->role->name) && Auth::user()->role->name == 'performer')
                $redirectTo = 'performer';
            else
                $redirectTo = 'admin';

            return redirect($redirectTo);
        }

        return $next($request);
    }
}
