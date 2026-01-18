@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
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
    <a href="{{ route('admin.penyaluran.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Penyaluran
    </a>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Total Donatur</h6>
                        <h2 class="mb-0 fw-bold">{{ number_format($total_donatur) }}</h2>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card stat-card" style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Total Korban</h6>
                        <h2 class="mb-0 fw-bold">{{ number_format($total_korban) }}</h2>
                        <small class="opacity-75">{{ $korban_pending }} pending verifikasi</small>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bi bi-person-exclamation"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Total Volunteer</h6>
                        <h2 class="mb-0 fw-bold">{{ number_format($total_volunteer) }}</h2>
                        <small class="opacity-75">Volunteer Aktif</small>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card stat-card" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Program Aktif</h6>
                        <h2 class="mb-0 fw-bold">{{ number_format($program_aktif) }}</h2>
                        <small class="opacity-75">dari {{ $total_program }} total</small>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bi bi-calendar-event-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Financial Summary -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-wallet2 text-success"></i> Total Donasi Terkumpul
                </h5>
                <h2 class="text-success fw-bold mb-2">Rp {{ number_format($total_donasi, 0, ',', '.') }}</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Donasi pending: {{ $donasi_pending }}</span>
                    <a href="{{ route('admin.donasi.index') }}" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-box-seam text-primary"></i> Total Bantuan Tersalurkan
                </h5>
                <h2 class="text-primary fw-bold mb-2">Rp {{ number_format($total_penyaluran, 0, ',', '.') }}</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Sisa dana: Rp {{ number_format($total_donasi - $total_penyaluran, 0, ',', '.') }}</span>
                    <a href="{{ route('admin.penyaluran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history text-primary"></i> Donasi Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Donatur</th>
                                <th>Program</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donasi_terbaru as $donasi)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $donasi->donatur->nama_donatur }}</div>
                                    <small class="text-muted">{{ $donasi->tanggal_donasi->format('d M Y') }}</small>
                                </td>
                                <td>{{ Str::limit($donasi->programBantuan->nama_program, 25) }}</td>
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
                                <td colspan="4" class="text-center text-muted py-4">Belum ada donasi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-box-seam text-success"></i> Penyaluran Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Korban</th>
                                <th>Program</th>
                                <th>Jumlah</th>
                                <th>Volunteer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penyaluran_terbaru as $penyaluran)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $penyaluran->korban->nama_korban }}</div>
                                    <small class="text-muted">{{ $penyaluran->tanggal_penyaluran->format('d M Y') }}</small>
                                </td>
                                <td>{{ Str::limit($penyaluran->programBantuan->nama_program, 20) }}</td>
                                <td class="fw-bold text-primary">Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}</td>
                                <td>
                                    <small>{{ $penyaluran->volunteer ? $penyaluran->volunteer->nama_volunteer : '-' }}</small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada penyaluran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
