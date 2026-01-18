<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use App\Models\Korban;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function registerDonatur(Request $request)
    {
        $request->validate([
            'nama_donatur' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:donaturs,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $donatur = Donatur::create([
            'nama_donatur' => $request->nama_donatur,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('donatur')->login($donatur);

        return redirect()->route('donatur.dashboard')->with('success', 'Registrasi berhasil!');
    }

    public function registerKorban(Request $request)
    {
        $request->validate([
            'nama_korban' => 'required|string|max:100',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:korbans,email',
            'jenis_bencana' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $korban = Korban::create([
            'nama_korban' => $request->nama_korban,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'jenis_bencana' => $request->jenis_bencana,
            'keterangan' => $request->keterangan,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'status_verifikasi' => 'pending',
        ]);

        Auth::guard('korban')->login($korban);

        return redirect()->route('korban.dashboard')->with('info', 'Registrasi berhasil! Menunggu verifikasi admin.');
    }

    public function registerVolunteer(Request $request)
    {
        $request->validate([
            'nama_volunteer' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:volunteers,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $volunteer = Volunteer::create([
            'nama_volunteer' => $request->nama_volunteer,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        Auth::guard('volunteer')->login($volunteer);

        return redirect()->route('volunteer.dashboard')->with('success', 'Registrasi volunteer berhasil!');
    }
}
