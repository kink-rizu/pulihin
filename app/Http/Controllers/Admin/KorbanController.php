<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Korban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KorbanController extends Controller
{
    public function index()
    {
        $korbans = Korban::latest()->paginate(10);
        return view('admin.korban.index', compact('korbans'));
    }

    public function create()
    {
        return view('admin.korban.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_korban' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_bencana' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        Korban::create([
            'nama_korban' => $request->nama_korban,
            'alamat' => $request->alamat,
            'jenis_bencana' => $request->jenis_bencana,
            'keterangan' => $request->keterangan,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'status_verifikasi' => 'terverifikasi',
        ]);

        return redirect()->route('admin.korban.index')
            ->with('success', 'Data korban berhasil ditambahkan!');
    }

    public function show(Korban $korban)
    {
        $korban->load(['kebutuhanKorbans', 'penyalurans.programBantuan']);
        return view('admin.korban.show', compact('korban'));
    }

    public function edit(Korban $korban)
    {
        return view('admin.korban.edit', compact('korban'));
    }

    public function update(Request $request, Korban $korban)
    {
        $request->validate([
            'nama_korban' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_bencana' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'no_hp' => 'required|string|max:15',
            'status_verifikasi' => 'required|in:pending,terverifikasi,ditolak',
        ]);

        $korban->update($request->except('password'));

        if ($request->filled('password')) {
            $korban->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.korban.index')
            ->with('success', 'Data korban berhasil diperbarui!');
    }

    public function destroy(Korban $korban)
    {
        $korban->delete();
        return redirect()->route('admin.korban.index')
            ->with('success', 'Data korban berhasil dihapus!');
    }

    public function verify(Korban $korban)
    {
        $korban->update(['status_verifikasi' => 'terverifikasi']);
        return back()->with('success', 'Korban berhasil diverifikasi!');
    }

    public function reject(Korban $korban)
    {
        $korban->update(['status_verifikasi' => 'ditolak']);
        return back()->with('success', 'Korban ditolak!');
    }
}
