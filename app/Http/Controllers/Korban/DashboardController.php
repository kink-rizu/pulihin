<?php

namespace App\Http\Controllers\Korban;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $korban = Auth::guard('korban')->user();
        
        $data = [
            'status_verifikasi' => $korban->status_verifikasi,
            'total_bantuan' => $korban->total_bantuan,
            'riwayat_bantuan' => $korban->penyalurans()
                ->with(['programBantuan', 'volunteer'])
                ->latest()
                ->paginate(10),
            'kebutuhan' => $korban->kebutuhanKorbans()
                ->latest()
                ->get(),
        ];

        return view('korban.dashboard', $data);
    }

    public function riwayatBantuan()
    {
        $bantuan = Auth::guard('korban')->user()
            ->penyalurans()
            ->with(['programBantuan', 'volunteer'])
            ->latest()
            ->paginate(15);

        return view('korban.bantuan.index', compact('bantuan'));
    }
}
