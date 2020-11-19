<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @param string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect("dashboard/students/create");
        }

        return $next($request);
    }
}
