<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Models\Korban;
use App\Models\ProgramBantuan;
use App\Models\Penyaluran;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_donatur' => Donatur::count(),
            'total_korban' => Korban::count(),
            'korban_pending' => Korban::pending()->count(),
            'total_volunteer' => Volunteer::aktif()->count(),
            'total_program' => ProgramBantuan::count(),
            'program_aktif' => ProgramBantuan::aktif()->count(),
            'total_donasi' => Donasi::berhasil()->sum('jumlah_donasi'),
            'total_penyaluran' => Penyaluran::sum('jumlah_disalurkan'),
            'donasi_pending' => Donasi::pending()->count(),
            'donasi_terbaru' => Donasi::with(['donatur', 'programBantuan'])
                ->latest()
                ->take(5)
                ->get(),
            'penyaluran_terbaru' => Penyaluran::with(['korban', 'programBantuan', 'volunteer'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
