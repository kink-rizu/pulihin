<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KorbanMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('korban')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai korban!');
        }

        return $next($request);
    }
}
