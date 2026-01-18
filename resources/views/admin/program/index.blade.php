@extends('layouts.app')

@section('title', 'Data Program Bantuan')
@section('page-title', 'Data Program Bantuan')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('admin.program.index') }}" class="nav-link active">
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
    <a href="{{ route('admin.penyaluran.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Penyaluran
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Daftar Program Bantuan</h5>
        <a href="{{ route('admin.program.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Program
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Jenis Bantuan</th>
                        <th>Periode</th>
                        <th>Target Dana</th>
                        <th>Dana Terkumpul</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $index => $program)
                    <tr>
                        <td>{{ $programs->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $program->nama_program }}</div>
                            <small class="text-muted">{{ Str::limit($program->keterangan, 50) }}</small>
                        </td>
                        <td><span class="badge bg-info">{{ $program->jenis_bantuan }}</span></td>
                        <td>
                            <small>
                                {{ $program->tanggal_mulai->format('d/m/Y') }} - 
                                {{ $program->tanggal_selesai->format('d/m/Y') }}
                            </small>
                        </td>
                        <td>Rp {{ number_format($program->target_dana, 0, ',', '.') }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</td>
                        <td>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" style="width: {{ min($program->persentase_dana_terkumpul, 100) }}%">
                                    {{ number_format($program->persentase_dana_terkumpul, 1) }}%
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($program->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.program.show', $program->id_program) }}" class="btn btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.program.edit', $program->id_program) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.program.destroy', $program->id_program) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3"></i>
                            <p class="mb-0 mt-2">Belum ada program bantuan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $programs->links() }}
    </div>
</div>
@endsection
