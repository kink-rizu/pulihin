@extends('layouts.app')

@section('title', 'Data Volunteer')
@section('page-title', 'Data Volunteer')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('admin.program.index') }}" class="nav-link">
        <i class="bi bi-calendar-event"></i> Program Bantuan
    </a>
    <a href="{{ route('admin.donasi.index') }}" class="nav-link">
        <i class="bi bi-cash-coin"></i> Donasi
    </a>
    <a href="{{ route('admin.korban.index') }}" class="nav-link">
        <i class="bi bi-people"></i> Data Korban
    </a>
    <a href="{{ route('admin.volunteer.index') }}" class="nav-link active">
        <i class="bi bi-person-badge"></i> Volunteer
    </a>
    <a href="{{ route('admin.penyaluran.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Penyaluran
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-person-badge"></i> Daftar Volunteer</h5>
        <a href="{{ route('admin.volunteer.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Volunteer
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Volunteer</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Total Penyaluran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($volunteers as $index => $volunteer)
                    <tr>
                        <td>{{ $volunteers->firstItem() + $index }}</td>
                        <td class="fw-semibold">{{ $volunteer->nama_volunteer }}</td>
                        <td><small>{{ Str::limit($volunteer->alamat, 40) }}</small></td>
                        <td>{{ $volunteer->email }}</td>
                        <td>{{ $volunteer->no_hp }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $volunteer->penyalurans_count }}</span>
                        </td>
                        <td>
                            @if($volunteer->status == 'aktif')
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Aktif</span>
                            @else
                                <span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.volunteer.show', $volunteer->id_volunteer) }}" class="btn btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.volunteer.edit', $volunteer->id_volunteer) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.volunteer.destroy', $volunteer->id_volunteer) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3"></i>
                            <p class="mb-0 mt-2">Belum ada data volunteer</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $volunteers->links() }}
    </div>
</div>
@endsection
