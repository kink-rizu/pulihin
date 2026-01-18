<?php

namespace App\Http\Controllers\Korban;

use App\Http\Controllers\Controller;
use App\Models\KebutuhanKorban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KebutuhanController extends Controller
{
    public function index()
    {
        $kebutuhans = KebutuhanKorban::where('id_korban', Auth::guard('korban')->id())
            ->latest()
            ->paginate(10);
        
        return view('korban.kebutuhan.index', compact('kebutuhans'));
    }

    public function create()
    {
        return view('korban.kebutuhan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:makanan,pakaian,obat-obatan,tempat_tinggal,lainnya',
            'nama_kebutuhan' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:20',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'keterangan' => 'nullable|string',
        ]);

        KebutuhanKorban::create([
            'id_korban' => Auth::guard('korban')->id(),
            'kategori' => $request->kategori,
            'nama_kebutuhan' => $request->nama_kebutuhan,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'prioritas' => $request->prioritas,
            'status' => 'dibutuhkan',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('korban.kebutuhan.index')
            ->with('success', 'Kebutuhan berhasil ditambahkan!');
    }

    public function edit(KebutuhanKorban $kebutuhan)
    {
        // Pastikan kebutuhan milik user yang login
        if ($kebutuhan->id_korban !== Auth::guard('korban')->id()) {
            abort(403);
        }

        return view('korban.kebutuhan.edit', compact('kebutuhan'));
    }

    public function update(Request $request, KebutuhanKorban $kebutuhan)
    {
        // Pastikan kebutuhan milik user yang login
        if ($kebutuhan->id_korban !== Auth::guard('korban')->id()) {
            abort(403);
        }

        $request->validate([
            'kategori' => 'required|in:makanan,pakaian,obat-obatan,tempat_tinggal,lainnya',
            'nama_kebutuhan' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:20',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'status' => 'required|in:dibutuhkan,terpenuhi_sebagian,terpenuhi',
            'keterangan' => 'nullable|string',
        ]);

        $kebutuhan->update($request->all());

        return redirect()->route('korban.kebutuhan.index')
            ->with('success', 'Kebutuhan berhasil diperbarui!');
    }

    public function destroy(KebutuhanKorban $kebutuhan)
    {
        // Pastikan kebutuhan milik user yang login
        if ($kebutuhan->id_korban !== Auth::guard('korban')->id()) {
            abort(403);
        }

        $kebutuhan->delete();

        return redirect()->route('korban.kebutuhan.index')
            ->with('success', 'Kebutuhan berhasil dihapus!');
    }
}
