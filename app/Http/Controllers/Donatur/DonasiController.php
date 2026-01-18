<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\ProgramBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    public function programs()
    {
        $programs = ProgramBantuan::aktif()->latest()->paginate(9);
        return view('donatur.program.index', compact('programs'));
    }

    public function create(ProgramBantuan $program)
    {
        return view('donatur.donasi.create', compact('program'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_program' => 'required|exists:program_bantuans,id_program',
            'jenis_donasi' => 'required|in:tunai,barang',
            'jumlah_donasi' => 'required|numeric|min:10000',
            'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $donasi = new Donasi();
        $donasi->id_donatur = Auth::guard('donatur')->id();
        $donasi->id_program = $request->id_program;
        $donasi->tanggal_donasi = now();
        $donasi->jenis_donasi = $request->jenis_donasi;
        $donasi->jumlah_donasi = $request->jumlah_donasi;
        $donasi->status_pembayaran = 'pending';

        // Upload bukti transfer jika ada
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bukti_transfer'), $filename);
            $donasi->bukti_transfer = $filename;
        }

        $donasi->save();

        return redirect()->route('donatur.dashboard')
            ->with('success', 'Donasi berhasil dikirim! Menunggu verifikasi admin.');
    }

    public function show(Donasi $donasi)
    {
        // Pastikan donasi milik user yang login
        if ($donasi->id_donatur !== Auth::guard('donatur')->id()) {
            abort(403);
        }

        return view('donatur.donasi.show', compact('donasi'));
    }
}
