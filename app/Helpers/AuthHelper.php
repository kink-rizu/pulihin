<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function getCurrentUser()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user();
        } elseif (Auth::guard('donatur')->check()) {
            return Auth::guard('donatur')->user();
        } elseif (Auth::guard('korban')->check()) {
            return Auth::guard('korban')->user();
        } elseif (Auth::guard('volunteer')->check()) {
            return Auth::guard('volunteer')->user();
        }
        
        return null;
    }

    public static function getCurrentUserName()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user()->nama_admin;
        } elseif (Auth::guard('donatur')->check()) {
            return Auth::guard('donatur')->user()->nama_donatur;
        } elseif (Auth::guard('korban')->check()) {
            return Auth::guard('korban')->user()->nama_korban;
        } elseif (Auth::guard('volunteer')->check()) {
            return Auth::guard('volunteer')->user()->nama_volunteer;
        }
        
        return 'User';
    }

    public static function getCurrentGuard()
    {
        if (Auth::guard('admin')->check()) {
            return 'admin';
        } elseif (Auth::guard('donatur')->check()) {
            return 'donatur';
        } elseif (Auth::guard('korban')->check()) {
            return 'korban';
        } elseif (Auth::guard('volunteer')->check()) {
            return 'volunteer';
        }
        
        return null;
    }
}
