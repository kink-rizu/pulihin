<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Penyaluran;
use App\Models\ProgramBantuan;
use App\Models\Korban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenyaluranController extends Controller
{
    public function index()
    {
        $volunteer = Auth::guard('volunteer')->user();
        
        $penyalurans = Penyaluran::with(['programBantuan', 'korban', 'volunteer'])
            ->where('id_volunteer', $volunteer->id_volunteer)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('volunteer.penyaluran.index', compact('penyalurans'));
    }

    public function create()
    {
        $programs = ProgramBantuan::where('status', 'aktif')->get();
        $korbans = Korban::where('status_verifikasi', 'terverifikasi')->get();

        return view('volunteer.penyaluran.create', compact('programs', 'korbans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_program' => 'required|exists:program_bantuans,id_program',
            'id_korban' => 'required|exists:korbans,id_korban',
            'tanggal_penyaluran' => 'required|date',
            'jumlah_disalurkan' => 'required|numeric|min:1000',
            'keterangan' => 'required|string',
            'foto_penyaluran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $volunteer = Auth::guard('volunteer')->user();

        $data = $request->all();
        $data['id_volunteer'] = $volunteer->id_volunteer;

        // Upload foto jika ada
        if ($request->hasFile('foto_penyaluran')) {
            $file = $request->file('foto_penyaluran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/penyaluran'), $filename);
            $data['foto_penyaluran'] = $filename;
        }

        Penyaluran::create($data);

        return redirect()->route('volunteer.penyaluran.index')
            ->with('success', 'Laporan penyaluran berhasil dibuat!');
    }

    public function show(Penyaluran $penyaluran)
    {
        // Pastikan volunteer hanya bisa lihat penyaluran miliknya sendiri
        $volunteer = Auth::guard('volunteer')->user();
        
        if ($penyaluran->id_volunteer != $volunteer->id_volunteer) {
            abort(403, 'Unauthorized action.');
        }

        $penyaluran->load(['programBantuan', 'korban', 'volunteer']);

        return view('volunteer.penyaluran.show', compact('penyaluran'));
    }

    public function edit(Penyaluran $penyaluran)
    {
        // Pastikan volunteer hanya bisa edit penyaluran miliknya sendiri
        $volunteer = Auth::guard('volunteer')->user();
        
        if ($penyaluran->id_volunteer != $volunteer->id_volunteer) {
            abort(403, 'Unauthorized action.');
        }

        $programs = ProgramBantuan::where('status', 'aktif')->get();
        $korbans = Korban::where('status_verifikasi', 'terverifikasi')->get();

        return view('volunteer.penyaluran.edit', compact('penyaluran', 'programs', 'korbans'));
    }

    public function update(Request $request, Penyaluran $penyaluran)
    {
        // Pastikan volunteer hanya bisa update penyaluran miliknya sendiri
        $volunteer = Auth::guard('volunteer')->user();
        
        if ($penyaluran->id_volunteer != $volunteer->id_volunteer) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'id_program' => 'required|exists:program_bantuans,id_program',
            'id_korban' => 'required|exists:korbans,id_korban',
            'tanggal_penyaluran' => 'required|date',
            'jumlah_disalurkan' => 'required|numeric|min:1000',
            'keterangan' => 'required|string',
            'foto_penyaluran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto_penyaluran');

        // Upload foto baru jika ada
        if ($request->hasFile('foto_penyaluran')) {
            // Hapus foto lama
            if ($penyaluran->foto_penyaluran) {
                $oldFile = public_path('uploads/penyaluran/' . $penyaluran->foto_penyaluran);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $file = $request->file('foto_penyaluran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/penyaluran'), $filename);
            $data['foto_penyaluran'] = $filename;
        }

        $penyaluran->update($data);

        return redirect()->route('volunteer.penyaluran.show', $penyaluran->id_penyaluran)
            ->with('success', 'Laporan penyaluran berhasil diupdate!');
    }

    public function destroy(Penyaluran $penyaluran)
    {
        // Pastikan volunteer hanya bisa hapus penyaluran miliknya sendiri
        $volunteer = Auth::guard('volunteer')->user();
        
        if ($penyaluran->id_volunteer != $volunteer->id_volunteer) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus foto jika ada
        if ($penyaluran->foto_penyaluran) {
            $file = public_path('uploads/penyaluran/' . $penyaluran->foto_penyaluran);
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $penyaluran->delete();

        return redirect()->route('volunteer.penyaluran.index')
            ->with('success', 'Laporan penyaluran berhasil dihapus!');
    }
}
