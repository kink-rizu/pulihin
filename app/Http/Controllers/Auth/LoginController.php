<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_or_username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,donatur,korban,volunteer',
        ]);

        $credentials = $request->only('password');
        $emailOrUsername = $request->email_or_username;
        $role = $request->role;

        // Tentukan guard dan field login berdasarkan role
        $guard = $role;
        $fieldName = ($role === 'admin') ? 'username' : 'email';
        
        $credentials[$fieldName] = $emailOrUsername;

        // Attempt login dengan guard yang sesuai
        if (Auth::guard($guard)->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            return redirect()->intended($this->redirectTo($role));
        }

        return back()->withErrors([
            'email_or_username' => 'Kredensial tidak cocok dengan data kami.',
        ])->onlyInput('email_or_username', 'role');
    }

    protected function redirectTo($role)
    {
        return match($role) {
            'admin' => route('admin.dashboard'),
            'donatur' => route('donatur.dashboard'),
            'korban' => route('korban.dashboard'),
            'volunteer' => route('volunteer.dashboard'),
            default => '/',
        };
    }
}
