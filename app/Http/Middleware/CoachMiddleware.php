<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CoachMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'coach') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Accès non autorisé.');
    }
}
