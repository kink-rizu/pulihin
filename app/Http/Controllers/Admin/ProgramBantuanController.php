<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramBantuan;
use Illuminate\Http\Request;

class ProgramBantuanController extends Controller
{
    public function index()
    {
        $programs = ProgramBantuan::latest()->paginate(10);
        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:100',
            'jenis_bantuan' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'target_dana' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        ProgramBantuan::create($request->all());

        return redirect()->route('admin.program.index')
            ->with('success', 'Program bantuan berhasil ditambahkan!');
    }

    public function show(ProgramBantuan $program)
    {
        $program->load(['donasis.donatur', 'penyalurans.korban']);
        return view('admin.program.show', compact('program'));
    }

    public function edit(ProgramBantuan $program)
    {
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, ProgramBantuan $program)
    {
        $request->validate([
            'nama_program' => 'required|string|max:100',
            'jenis_bantuan' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'target_dana' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai',
            'keterangan' => 'nullable|string',
        ]);

        $program->update($request->all());

        return redirect()->route('admin.program.index')
            ->with('success', 'Program bantuan berhasil diperbarui!');
    }

    public function destroy(ProgramBantuan $program)
    {
        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program bantuan berhasil dihapus!');
    }
}
