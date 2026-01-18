@extends('layouts.app')

@section('title', 'Data Penyaluran')
@section('page-title', 'Data Penyaluran Bantuan')

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
    <a href="{{ route('admin.volunteer.index') }}" class="nav-link">
        <i class="bi bi-person-badge"></i> Volunteer
    </a>
    <a href="{{ route('admin.penyaluran.index') }}" class="nav-link active">
        <i class="bi bi-box-seam"></i> Penyaluran
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-box-seam"></i> Data Penyaluran Bantuan</h5>
        <a href="{{ route('admin.penyaluran.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Penyaluran
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Program</th>
                        <th>Korban</th>
                        <th>Volunteer</th>
                        <th>Jumlah Disalurkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyalurans as $index => $penyaluran)
                    <tr>
                        <td>{{ $penyalurans->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $penyaluran->tanggal_penyaluran->format('d M Y') }}</div>
                            <small class="text-muted">{{ $penyaluran->tanggal_penyaluran->format('H:i') }} WIB</small>
                        </td>
                        <td>
                            <div>{{ Str::limit($penyaluran->programBantuan->nama_program, 30) }}</div>
                            <small><span class="badge bg-info">{{ $penyaluran->programBantuan->jenis_bantuan }}</span></small>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $penyaluran->korban->nama_korban }}</div>
                            <small class="text-muted">{{ $penyaluran->korban->jenis_bencana }}</small>
                        </td>
                        <td>{{ $penyaluran->volunteer ? $penyaluran->volunteer->nama_volunteer : '-' }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.penyaluran.show', $penyaluran->id_penyaluran) }}" class="btn btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.penyaluran.edit', $penyaluran->id_penyaluran) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.penyaluran.destroy', $penyaluran->id_penyaluran) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus penyaluran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1"></i>
                            <p class="mb-0 mt-2">Belum ada data penyaluran</p>
                            <a href="{{ route('admin.penyaluran.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="bi bi-plus-circle"></i> Tambah Data Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($penyalurans->hasPages())
    <div class="card-footer bg-white">
        {{ $penyalurans->links() }}
    </div>
    @endif
</div>
@endsection
