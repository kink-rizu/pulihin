@extends('layouts.app')

@section('title', 'Penyaluran Bantuan')
@section('page-title', 'Penyaluran Bantuan')

@section('sidebar')
    <a href="{{ route('volunteer.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('volunteer.penyaluran.index') }}" class="nav-link active">
        <i class="bi bi-box-seam"></i> Penyaluran
    </a>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Daftar Penyaluran Bantuan</h5>
                <a href="{{ route('volunteer.penyaluran.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Buat Laporan Penyaluran
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
                                <th>Lokasi</th>
                                <th>Jumlah Disalurkan</th>
                                <th>Status</th>
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
                                    <small class="text-muted">
                                        <span class="badge bg-info">{{ $penyaluran->programBantuan->jenis_bantuan }}</span>
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $penyaluran->korban->nama_korban }}</div>
                                    <small class="text-muted">{{ $penyaluran->korban->jenis_bencana }}</small>
                                </td>
                                <td><small>{{ Str::limit($penyaluran->korban->alamat, 30) }}</small></td>
                                <td class="fw-bold text-success">Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Tersalurkan
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('volunteer.penyaluran.show', $penyaluran->id_penyaluran) }}" class="btn btn-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('volunteer.penyaluran.edit', $penyaluran->id_penyaluran) }}" class="btn btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1"></i>
                                    <p class="mb-0 mt-2">Belum ada data penyaluran</p>
                                    <a href="{{ route('volunteer.penyaluran.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-plus-circle"></i> Buat Laporan Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                {{ $penyalurans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
