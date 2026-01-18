@extends('layouts.app')

@section('title', 'Detail Volunteer')
@section('page-title', 'Detail Volunteer')

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
    <a href="{{ route('admin.volunteer.index') }}" class="nav-link active">
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
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Volunteer</h5>
                @if($volunteer->status == 'aktif')
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-secondary">Nonaktif</span>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Nama Volunteer</th>
                        <td>: {{ $volunteer->nama_volunteer }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $volunteer->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $volunteer->email }}</td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>: {{ $volunteer->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Total Penyaluran</th>
                        <td>: <span class="badge bg-primary">{{ $volunteer->penyalurans->count() }}</span></td>
                    </tr>
                    <tr>
                        <th>Total Bantuan Disalurkan</th>
                        <td>: <span class="fw-bold text-success">Rp {{ number_format($volunteer->total_bantuan_disalurkan, 0, ',', '.') }}</span></td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.volunteer.edit', $volunteer->id_volunteer) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.volunteer.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Riwayat Penyaluran -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Riwayat Penyaluran ({{ $volunteer->penyalurans->count() }})</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Program</th>
                                <th>Korban</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($volunteer->penyalurans as $penyaluran)
                            <tr>
                                <td>{{ $penyaluran->tanggal_penyaluran->format('d M Y') }}</td>
                                <td>{{ $penyaluran->programBantuan->nama_program }}</td>
                                <td>{{ $penyaluran->korban->nama_korban }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}</td>
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
                <h6 class="text-muted mb-2">Total Penyaluran</h6>
                <h3 class="text-primary mb-0">{{ $volunteer->penyalurans->count() }}</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">Total Disalurkan</h6>
                <h3 class="text-success mb-0">Rp {{ number_format($volunteer->total_bantuan_disalurkan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

@endsection
