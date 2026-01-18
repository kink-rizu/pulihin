@extends('layouts.app')

@section('title', 'Dashboard Korban')
@section('page-title', 'Dashboard Korban')

@section('sidebar')
    <a href="{{ route('korban.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('korban.kebutuhan.index') }}" class="nav-link">
        <i class="bi bi-list-check"></i> Kebutuhan Saya
    </a>
    <a href="{{ route('korban.bantuan.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Riwayat Bantuan
    </a>
@endsection

@section('content')
<!-- Status Verifikasi Alert -->
@if($status_verifikasi == 'pending')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong>Akun Anda Menunggu Verifikasi</strong>
    <p class="mb-0 mt-2">Akun Anda sedang dalam proses verifikasi oleh admin. Beberapa fitur mungkin terbatas sampai akun terverifikasi.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@elseif($status_verifikasi == 'ditolak')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-x-circle-fill"></i>
    <strong>Akun Anda Ditolak</strong>
    <p class="mb-0 mt-2">Mohon hubungi admin untuk informasi lebih lanjut.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@else
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill"></i>
    <strong>Akun Terverifikasi</strong>
    <p class="mb-0 mt-2">Akun Anda telah terverifikasi dan dapat mengakses semua fitur.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0" style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);">
            <div class="card-body text-white p-4">
                <h3 class="mb-2">Halo, {{ Auth::guard('korban')->user()->nama_korban }}</h3>
                <p class="mb-0 opacity-75">Kami siap membantu Anda di masa sulit ini</p>
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
                        <h6 class="text-muted mb-2">Total Bantuan Diterima</h6>
                        <h2 class="text-success fw-bold mb-0">Rp {{ number_format($total_bantuan, 0, ',', '.') }}</h2>
                    </div>
                    <div class="fs-1 text-success opacity-50">
                        <i class="bi bi-gift"></i>
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
                        <h6 class="text-muted mb-2">Kebutuhan Terdaftar</h6>
                        <h2 class="text-primary fw-bold mb-0">{{ $kebutuhan->count() }} Item</h2>
                    </div>
                    <div class="fs-1 text-primary opacity-50">
                        <i class="bi bi-list-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kebutuhan Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-list-check text-primary"></i> Daftar Kebutuhan Saya
                </h5>
                <a href="{{ route('korban.kebutuhan.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Kebutuhan
                </a>
            </div>
            <div class="card-body">
                @if($kebutuhan->count() > 0)
                <div class="row">
                    @foreach($kebutuhan as $item)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="card-title fw-bold mb-0">{{ $item->nama_kebutuhan }}</h6>
                                    @if($item->prioritas == 'tinggi')
                                        <span class="badge bg-danger">Prioritas Tinggi</span>
                                    @elseif($item->prioritas == 'sedang')
                                        <span class="badge bg-warning">Prioritas Sedang</span>
                                    @else
                                        <span class="badge bg-info">Prioritas Rendah</span>
                                    @endif
                                </div>
                                
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-tag"></i> {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                                </p>
                                
                                <div class="mb-3">
                                    <strong>Jumlah:</strong> {{ $item->jumlah }} {{ $item->satuan }}
                                </div>

                                @if($item->keterangan)
                                <p class="small text-muted mb-3">{{ Str::limit($item->keterangan, 60) }}</p>
                                @endif

                                <div class="d-flex justify-content-between align-items-center">
                                    @if($item->status == 'terpenuhi')
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Terpenuhi</span>
                                    @elseif($item->status == 'terpenuhi_sebagian')
                                        <span class="badge bg-warning"><i class="bi bi-hourglass-split"></i> Sebagian</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="bi bi-clock"></i> Dibutuhkan</span>
                                    @endif
                                    
                                    <div>
                                        <a href="{{ route('korban.kebutuhan.edit', $item->id_kebutuhan) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <p class="text-muted mt-2">Belum ada kebutuhan yang terdaftar</p>
                    <a href="{{ route('korban.kebutuhan.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Kebutuhan Pertama
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Bantuan -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history text-success"></i> Riwayat Bantuan
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Program</th>
                                <th>Jumlah Bantuan</th>
                                <th>Volunteer</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat_bantuan as $bantuan)
                            <tr>
                                <td>{{ $bantuan->tanggal_penyaluran->format('d M Y') }}</td>
                                <td class="fw-semibold">{{ Str::limit($bantuan->programBantuan->nama_program, 30) }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($bantuan->jumlah_disalurkan, 0, ',', '.') }}</td>
                                <td>
                                    @if($bantuan->volunteer)
                                        <small>{{ $bantuan->volunteer->nama_volunteer }}</small>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ Str::limit($bantuan->keterangan ?? '-', 40) }}</small></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3"></i>
                                    <p class="mb-0 mt-2">Belum ada bantuan yang diterima</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($riwayat_bantuan->hasPages())
            <div class="card-footer bg-white">
                {{ $riwayat_bantuan->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
