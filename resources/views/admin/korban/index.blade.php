@extends('layouts.app')

@section('title', 'Data Korban')
@section('page-title', 'Data Korban')

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
    <a href="{{ route('admin.korban.index') }}" class="nav-link active">
        <i class="bi bi-people"></i> Data Korban
    </a>
    <a href="{{ route('admin.volunteer.index') }}" class="nav-link">
        <i class="bi bi-person-badge"></i> Volunteer
    </a>
    <a href="{{ route('admin.penyaluran.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Penyaluran
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-people"></i> Daftar Korban Bencana</h5>
        <a href="{{ route('admin.korban.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Korban
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Korban</th>
                        <th>Alamat</th>
                        <th>Jenis Bencana</th>
                        <th>No. HP</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($korbans as $index => $korban)
                    <tr>
                        <td>{{ $korbans->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $korban->nama_korban }}</div>
                            <small class="text-muted">{{ $korban->keterangan ? Str::limit($korban->keterangan, 30) : '-' }}</small>
                        </td>
                        <td><small>{{ Str::limit($korban->alamat, 40) }}</small></td>
                        <td><span class="badge bg-warning">{{ $korban->jenis_bencana }}</span></td>
                        <td>{{ $korban->no_hp }}</td>
                        <td>
                            @if($korban->status_verifikasi == 'terverifikasi')
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Terverifikasi</span>
                            @elseif($korban->status_verifikasi == 'pending')
                                <span class="badge bg-warning"><i class="bi bi-clock"></i> Pending</span>
                            @else
                                <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.korban.show', $korban->id_korban) }}" class="btn btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.korban.edit', $korban->id_korban) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($korban->status_verifikasi == 'pending')
                                    <form action="{{ route('admin.korban.verify', $korban->id_korban) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success" title="Verifikasi">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.korban.destroy', $korban->id_korban) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3"></i>
                            <p class="mb-0 mt-2">Belum ada data korban</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $korbans->links() }}
    </div>
</div>
@endsection
