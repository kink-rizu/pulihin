<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Penyaluran;

class DashboardController extends Controller
{
    public function index()
    {
        $volunteer = Auth::guard('volunteer')->user();
        
        $data = [
            'jumlah_penyaluran' => $volunteer->jumlah_penyaluran,
            'total_bantuan_disalurkan' => $volunteer->total_bantuan_disalurkan,
            'penyaluran_terbaru' => $volunteer->penyalurans()
                ->with(['korban', 'programBantuan'])
                ->latest()
                ->take(10)
                ->get(),
            'penyaluran_bulan_ini' => Penyaluran::where('id_volunteer', $volunteer->id_volunteer)
                ->bulanIni()
                ->count(),
        ];

        return view('volunteer.dashboard', $data);
    }

}
