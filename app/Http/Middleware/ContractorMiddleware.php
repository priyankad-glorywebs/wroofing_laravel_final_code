<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Auth;

// class ContractorMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next,$guard = null): Response
//     {
//         if ($guard) {
//             dd($guard);
//             Auth::shouldUse($guard);
//         }
//         return $next($request);
//     }
//}


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */


public function handle(Request $request, Closure $next, $guard = null)
{
    if ($guard) {
        Auth::shouldUse($guard);
    }

    if (Auth::check()) {
        if (Auth::guard('contractor')->check()) {
            if ($request->is('contractor/login')) {
                return redirect()->route('contractor.dashboard');
            }
            return $next($request);
        } else {
            return redirect()->route('contractor.login');
        }
    } else {
        return redirect()->route('contractor.login');
    }
}

}

