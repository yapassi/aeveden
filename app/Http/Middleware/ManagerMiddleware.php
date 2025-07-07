<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'manager') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Accès non autorisé.');
    }
}
