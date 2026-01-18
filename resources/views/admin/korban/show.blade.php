@extends('layouts.app')

@section('title', 'Detail Korban')
@section('page-title', 'Detail Data Korban')

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
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Korban</h5>
                @if($korban->status_verifikasi == 'terverifikasi')
                    <span class="badge bg-success">Terverifikasi</span>
                @elseif($korban->status_verifikasi == 'pending')
                    <span class="badge bg-warning">Pending</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Nama Korban</th>
                        <td>: {{ $korban->nama_korban }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $korban->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Bencana</th>
                        <td>: <span class="badge bg-warning">{{ $korban->jenis_bencana }}</span></td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>: {{ $korban->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: {{ $korban->keterangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Total Bantuan Diterima</th>
                        <td>: <span class="fw-bold text-success">Rp {{ number_format($korban->total_bantuan, 0, ',', '.') }}</span></td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-4">
                    @if($korban->status_verifikasi == 'pending')
                        <form action="{{ route('admin.korban.verify', $korban->id_korban) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Verifikasi
                            </button>
                        </form>
                        <form action="{{ route('admin.korban.reject', $korban->id_korban) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Tolak
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('admin.korban.edit', $korban->id_korban) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.korban.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Daftar Kebutuhan -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-list-check"></i> Daftar Kebutuhan ({{ $korban->kebutuhanKorbans->count() }})</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kategori</th>
                                <th>Nama Kebutuhan</th>
                                <th>Jumlah</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($korban->kebutuhanKorbans as $kebutuhan)
                            <tr>
                                <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $kebutuhan->kategori)) }}</span></td>
                                <td>{{ $kebutuhan->nama_kebutuhan }}</td>
                                <td>{{ $kebutuhan->jumlah }} {{ $kebutuhan->satuan }}</td>
                                <td>
                                    @if($kebutuhan->prioritas == 'tinggi')
                                        <span class="badge bg-danger">Tinggi</span>
                                    @elseif($kebutuhan->prioritas == 'sedang')
                                        <span class="badge bg-warning">Sedang</span>
                                    @else
                                        <span class="badge bg-info">Rendah</span>
                                    @endif
                                </td>
                                <td>
                                    @if($kebutuhan->status == 'terpenuhi')
                                        <span class="badge bg-success">Terpenuhi</span>
                                    @elseif($kebutuhan->status == 'terpenuhi_sebagian')
                                        <span class="badge bg-warning">Sebagian</span>
                                    @else
                                        <span class="badge bg-secondary">Dibutuhkan</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada kebutuhan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Riwayat Penyaluran -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Riwayat Penyaluran ({{ $korban->penyalurans->count() }})</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Program</th>
                                <th>Jumlah</th>
                                <th>Volunteer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($korban->penyalurans as $penyaluran)
                            <tr>
                                <td>{{ $penyaluran->tanggal_penyaluran->format('d M Y') }}</td>
                                <td>{{ $penyaluran->programBantuan->nama_program }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}</td>
                                <td>{{ $penyaluran->volunteer ? $penyaluran->volunteer->nama_volunteer : '-' }}</td>
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
                <h6 class="text-muted mb-2">Jumlah Kebutuhan</h6>
                <h3 class="text-primary mb-0">{{ $korban->kebutuhanKorbans->count() }}</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">Jumlah Penyaluran</h6>
                <h3 class="text-success mb-0">{{ $korban->penyalurans->count() }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
