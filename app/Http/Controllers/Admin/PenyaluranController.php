<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyaluran;
use App\Models\ProgramBantuan;
use App\Models\Korban;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class PenyaluranController extends Controller
{
    public function index()
    {
        $penyalurans = Penyaluran::with(['programBantuan', 'korban', 'volunteer'])
            ->latest()
            ->paginate(15);
        
        return view('admin.penyaluran.index', compact('penyalurans'));
    }

    public function create()
    {
        $programs = ProgramBantuan::aktif()->get();
        $korbans = Korban::terverifikasi()->get();
        $volunteers = Volunteer::aktif()->get();
        
        return view('admin.penyaluran.create', compact('programs', 'korbans', 'volunteers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_program' => 'required|exists:program_bantuans,id_program',
            'id_korban' => 'required|exists:korbans,id_korban',
            'id_volunteer' => 'nullable|exists:volunteers,id_volunteer',
            'tanggal_penyaluran' => 'required|date',
            'jumlah_disalurkan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'foto_bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $penyaluran = new Penyaluran($request->except('foto_bukti'));

        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/penyaluran'), $filename);
            $penyaluran->foto_bukti = $filename;
        }

        $penyaluran->save();

        return redirect()->route('admin.penyaluran.index')
            ->with('success', 'Penyaluran berhasil ditambahkan!');
    }

    public function show(Penyaluran $penyaluran)
    {
        $penyaluran->load(['programBantuan', 'korban', 'volunteer']);
        return view('admin.penyaluran.show', compact('penyaluran'));
    }

    public function edit(Penyaluran $penyaluran)
    {
        $programs = ProgramBantuan::all();
        $korbans = Korban::all();
        $volunteers = Volunteer::all();
        
        return view('admin.penyaluran.edit', compact('penyaluran', 'programs', 'korbans', 'volunteers'));
    }

    public function update(Request $request, Penyaluran $penyaluran)
    {
        $request->validate([
            'id_program' => 'required|exists:program_bantuans,id_program',
            'id_korban' => 'required|exists:korbans,id_korban',
            'id_volunteer' => 'nullable|exists:volunteers,id_volunteer',
            'tanggal_penyaluran' => 'required|date',
            'jumlah_disalurkan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'foto_bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $penyaluran->fill($request->except('foto_bukti'));

        if ($request->hasFile('foto_bukti')) {
            // Delete old file
            if ($penyaluran->foto_bukti && file_exists(public_path('uploads/penyaluran/' . $penyaluran->foto_bukti))) {
                unlink(public_path('uploads/penyaluran/' . $penyaluran->foto_bukti));
            }

            $file = $request->file('foto_bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/penyaluran'), $filename);
            $penyaluran->foto_bukti = $filename;
        }

        $penyaluran->save();

        return redirect()->route('admin.penyaluran.index')
            ->with('success', 'Penyaluran berhasil diperbarui!');
    }

    public function destroy(Penyaluran $penyaluran)
    {
        if ($penyaluran->foto_bukti && file_exists(public_path('uploads/penyaluran/' . $penyaluran->foto_bukti))) {
            unlink(public_path('uploads/penyaluran/' . $penyaluran->foto_bukti));
        }

        $penyaluran->delete();
        
        return redirect()->route('admin.penyaluran.index')
            ->with('success', 'Penyaluran berhasil dihapus!');
    }
}
