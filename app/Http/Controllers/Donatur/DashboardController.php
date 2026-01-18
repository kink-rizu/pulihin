<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Models\ProgramBantuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $donatur = Auth::guard('donatur')->user();
        
        $data = [
            'total_donasi' => $donatur->total_donasi,
            'jumlah_donasi' => $donatur->jumlah_donasi,
            'riwayat_donasi' => $donatur->donasis()
                ->with('programBantuan')
                ->latest()
                ->paginate(10),
            'program_aktif' => ProgramBantuan::aktif()
                ->latest()
                ->take(6)
                ->get(),
        ];

        return view('donatur.dashboard', $data);
    }
}
