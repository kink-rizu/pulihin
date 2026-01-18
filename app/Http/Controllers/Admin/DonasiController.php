<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        $donasis = Donasi::with(['donatur', 'programBantuan'])
            ->latest()
            ->paginate(15);
        
        return view('admin.donasi.index', compact('donasis'));
    }

    public function show(Donasi $donasi)
    {
        $donasi->load(['donatur', 'programBantuan']);
        return view('admin.donasi.show', compact('donasi'));
    }

    public function verify(Donasi $donasi)
    {
        $donasi->update(['status_pembayaran' => 'berhasil']);
        return back()->with('success', 'Donasi berhasil diverifikasi!');
    }

    public function reject(Donasi $donasi)
    {
        $donasi->update(['status_pembayaran' => 'gagal']);
        return back()->with('success', 'Donasi ditolak!');
    }

    public function destroy(Donasi $donasi)
    {
        if ($donasi->bukti_transfer && file_exists(public_path('uploads/bukti_transfer/' . $donasi->bukti_transfer))) {
            unlink(public_path('uploads/bukti_transfer/' . $donasi->bukti_transfer));
        }
        
        $donasi->delete();
        return redirect()->route('admin.donasi.index')
            ->with('success', 'Donasi berhasil dihapus!');
    }
}
