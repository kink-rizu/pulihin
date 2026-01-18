@extends('layouts.app')

@section('title', 'Dashboard Volunteer')
@section('page-title', 'Dashboard Volunteer')

@section('sidebar')
    <a href="{{ route('volunteer.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('volunteer.penyaluran.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Data Penyaluran
    </a>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body text-white p-4">
                <h3 class="mb-2">Selamat Datang, {{ Auth::guard('volunteer')->user()->nama_volunteer }}! 💪</h3>
                <p class="mb-0 opacity-75">Terima kasih atas dedikasi Anda membantu menyalurkan bantuan</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Penyaluran</h6>
                        <h2 class="text-primary fw-bold mb-0">{{ $jumlah_penyaluran }}</h2>
                        <small class="text-muted">Sepanjang masa</small>
                    </div>
                    <div class="fs-1 text-primary opacity-50">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Bantuan Disalurkan</h6>
                        <h2 class="text-success fw-bold mb-0">Rp {{ number_format($total_bantuan_disalurkan, 0, ',', '.') }}</h2>
                    </div>
                    <div class="fs-1 text-success opacity-50">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Bulan Ini</h6>
                        <h2 class="text-warning fw-bold mb-0">{{ $penyaluran_bulan_ini }}</h2>
                        <small class="text-muted">Penyaluran</small>
                    </div>
                    <div class="fs-1 text-warning opacity-50">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-charge text-warning"></i> Aksi Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <a href="{{ route('volunteer.penyaluran.create') }}" class="btn btn-lg btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Buat Penyaluran Baru
                        </a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="{{ route('volunteer.penyaluran.index') }}" class="btn btn-lg btn-outline-primary w-100">
                            <i class="bi bi-list"></i> Lihat Semua Penyaluran
                        </a>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- Penyaluran Terbaru -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history text-success"></i> Penyaluran Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Program</th>
                                <th>Korban</th>
                                <th>Lokasi</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penyaluran_terbaru as $penyaluran)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $penyaluran->tanggal_penyaluran->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $penyaluran->tanggal_penyaluran->diffForHumans() }}</small>
                                </td>
                                <td>{{ Str::limit($penyaluran->programBantuan->nama_program, 25) }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $penyaluran->korban->nama_korban }}</div>
                                    <small class="text-muted">{{ $penyaluran->korban->jenis_bencana }}</small>
                                </td>
                                <td><small class="text-muted">{{ Str::limit($penyaluran->korban->alamat, 30) }}</small></td>
                                <td class="fw-bold text-success">Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}</td>
                                <td>
                                    @if($penyaluran->foto_bukti)
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Selesai</span>
                                    @else
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('volunteer.penyaluran.show', $penyaluran->id_penyaluran) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('volunteer.penyaluran.edit', $penyaluran->id_penyaluran) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3"></i>
                                    <p class="mb-0 mt-2">Belum ada penyaluran</p>
                                    <a href="{{ route('volunteer.penyaluran.create') }}" class="btn btn-sm btn-primary mt-2">
                                        <i class="bi bi-plus-circle"></i> Buat Penyaluran Pertama
                                    </a>
                                </td>
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
