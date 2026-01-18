<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonaturMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('donatur')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai donatur!');
        }

        return $next($request);
    }
}
