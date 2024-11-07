<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasVerifiedEmail()) {
                if ($user instanceof \App\Models\User || $user instanceof \App\Models\Contractor) {
                    return $next($request);
                }
            } else {
                Auth::logout();
                return redirect()->back()->withInput()->with(['error' => 'Your email is not verified. Please check your email for the verification link.']);
            }
        }
    
        //return redirect('/login')->with('error', 'Unauthorized. Please log in.');

        return redirect()->route('login')->with('error', 'Unauthorized. Please log in.');
    }
}
