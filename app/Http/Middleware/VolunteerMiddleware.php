<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('volunteer')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai volunteer!');
        }

        return $next($request);
    }
}
