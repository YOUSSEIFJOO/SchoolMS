<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class AssignGuard
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if (Auth::guard("student")->check() || Auth::guard("teacher")->check() || Auth::guard("employee")->check()) {
//            return $next($request);
//        } else {
//            return redirect()->route("dashboard.showLoginForm");
//        }

        return $next($request);

    }
}
