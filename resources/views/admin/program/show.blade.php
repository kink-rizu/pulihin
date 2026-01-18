@extends('layouts.app')

@section('title', 'Detail Program Bantuan')
@section('page-title', 'Detail Program Bantuan')

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
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Program</h5>
                <div>
                    @if($program->status == 'aktif')
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Selesai</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <h3 class="mb-3">{{ $program->nama_program }}</h3>
                
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Jenis Bantuan</th>
                        <td>: <span class="badge bg-info">{{ $program->jenis_bantuan }}</span></td>
                    </tr>
                    <tr>
                        <th>Periode</th>
                        <td>: {{ $program->tanggal_mulai->format('d F Y') }} - {{ $program->tanggal_selesai->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Target Dana</th>
                        <td>: <span class="fw-bold">Rp {{ number_format($program->target_dana, 0, ',', '.') }}</span></td>
                    </tr>
                    <tr>
                        <th>Dana Terkumpul</th>
                        <td>: <span class="fw-bold text-success">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</span></td>
                    </tr>
                    <tr>
                        <th>Progress</th>
                        <td>
                            : <div class="progress" style="height: 25px; width: 300px;">
                                <div class="progress-bar bg-success" style="width: {{ min($program->persentase_dana_terkumpul, 100) }}%">
                                    <strong>{{ number_format($program->persentase_dana_terkumpul, 1) }}%</strong>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: {{ $program->keterangan ?? '-' }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.program.edit', $program->id_program) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.program.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Daftar Donasi -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-cash-coin"></i> Daftar Donasi ({{ $program->donasis->count() }})</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Donatur</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($program->donasis as $donasi)
                            <tr>
                                <td>{{ $donasi->tanggal_donasi->format('d M Y') }}</td>
                                <td>{{ $donasi->donatur->nama_donatur }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($donasi->jenis_donasi) }}</span></td>
                                <td class="fw-bold text-success">Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</td>
                                <td>
                                    @if($donasi->status_pembayaran == 'berhasil')
                                        <span class="badge bg-success">Berhasil</span>
                                    @elseif($donasi->status_pembayaran == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada donasi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Daftar Penyaluran -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Daftar Penyaluran ({{ $program->penyalurans->count() }})</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Korban</th>
                                <th>Volunteer</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($program->penyalurans as $penyaluran)
                            <tr>
                                <td>{{ $penyaluran->tanggal_penyaluran->format('d M Y') }}</td>
                                <td>{{ $penyaluran->korban->nama_korban }}</td>
                                <td>{{ $penyaluran->volunteer ? $penyaluran->volunteer->nama_volunteer : '-' }}</td>
                                <td class="fw-bold text-primary">Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada penyaluran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">Total Donasi</h6>
                <h3 class="text-success mb-0">{{ $program->donasis->count() }}</h3>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">Total Penyaluran</h6>
                <h3 class="text-primary mb-0">{{ $program->penyalurans->count() }}</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">Sisa Dana</h6>
                <h3 class="text-warning mb-0">Rp {{ number_format($program->dana_terkumpul - $program->total_tersalurkan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
