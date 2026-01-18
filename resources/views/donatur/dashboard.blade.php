@extends('layouts.app')

@section('title', 'Dashboard Donatur')
@section('page-title', 'Dashboard Donatur')

@section('sidebar')
    <a href="{{ route('donatur.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('donatur.program.index') }}" class="nav-link">
        <i class="bi bi-calendar-event"></i> Program Donasi
    </a>
    <a href="#" class="nav-link">
        <i class="bi bi-clock-history"></i> Riwayat Donasi
    </a>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body text-white p-4">
                <h3 class="mb-2">Selamat Datang, {{ Auth::guard('donatur')->user()->nama_donatur }}! 👋</h3>
                <p class="mb-0 opacity-75">Terima kasih atas kontribusi Anda dalam membantu sesama</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Donasi Anda</h6>
                        <h2 class="text-success fw-bold mb-0">Rp {{ number_format($total_donasi, 0, ',', '.') }}</h2>
                    </div>
                    <div class="fs-1 text-success opacity-50">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Jumlah Donasi</h6>
                        <h2 class="text-primary fw-bold mb-0">{{ $jumlah_donasi }} Kali</h2>
                    </div>
                    <div class="fs-1 text-primary opacity-50">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Program Aktif -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-calendar-event text-primary"></i> Program Bantuan Aktif
                </h5>
                <a href="{{ route('donatur.program.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua Program
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($program_aktif as $program)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $program->nama_program }}</h6>
                                <p class="card-text text-muted small mb-3">{{ Str::limit($program->keterangan, 80) }}</p>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="text-muted">Dana Terkumpul</small>
                                        <small class="fw-bold">{{ number_format($program->persentase_dana_terkumpul, 1) }}%</small>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: {{ min($program->persentase_dana_terkumpul, 100) }}%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-1">
                                        <small class="text-success fw-bold">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</small>
                                        <small class="text-muted">Target: Rp {{ number_format($program->target_dana, 0, ',', '.') }}</small>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">{{ $program->jenis_bantuan }}</span>
                                    <a href="{{ route('donatur.donasi.create', $program->id_program) }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-heart"></i> Donasi Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <p class="text-muted mt-2">Belum ada program aktif saat ini</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Donasi -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history text-success"></i> Riwayat Donasi Terakhir
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Program</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat_donasi as $donasi)
                            <tr>
                                <td>{{ $donasi->tanggal_donasi->format('d M Y') }}</td>
                                <td>
                                    <div class="fw-semibold">{{ Str::limit($donasi->programBantuan->nama_program, 30) }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($donasi->jenis_donasi) }}</span>
                                </td>
                                <td class="fw-bold text-success">Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</td>
                                <td>
                                    @if($donasi->status_pembayaran == 'berhasil')
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Berhasil</span>
                                    @elseif($donasi->status_pembayaran == 'pending')
                                        <span class="badge bg-warning"><i class="bi bi-clock"></i> Pending</span>
                                    @else
                                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Gagal</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('donatur.donasi.show', $donasi->id_donasi) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3"></i>
                                    <p class="mb-0 mt-2">Anda belum melakukan donasi</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($riwayat_donasi->hasPages())
            <div class="card-footer bg-white">
                {{ $riwayat_donasi->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
