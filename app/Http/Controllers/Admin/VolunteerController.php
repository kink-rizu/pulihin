<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::withCount('penyalurans')->latest()->paginate(10);
        return view('admin.volunteer.index', compact('volunteers'));
    }

    public function create()
    {
        return view('admin.volunteer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_volunteer' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:volunteers,email',
            'password' => 'required|string|min:6',
        ]);

        Volunteer::create([
            'nama_volunteer' => $request->nama_volunteer,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        return redirect()->route('admin.volunteer.index')
            ->with('success', 'Volunteer berhasil ditambahkan!');
    }

    public function show(Volunteer $volunteer)
    {
        $volunteer->load(['penyalurans.korban', 'penyalurans.programBantuan']);
        return view('admin.volunteer.show', compact('volunteer'));
    }

    public function edit(Volunteer $volunteer)
    {
        return view('admin.volunteer.edit', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $request->validate([
            'nama_volunteer' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:volunteers,email,' . $volunteer->id_volunteer . ',id_volunteer',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $volunteer->update($request->except('password'));

        if ($request->filled('password')) {
            $volunteer->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.volunteer.index')
            ->with('success', 'Data volunteer berhasil diperbarui!');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('admin.volunteer.index')
            ->with('success', 'Volunteer berhasil dihapus!');
    }
}
