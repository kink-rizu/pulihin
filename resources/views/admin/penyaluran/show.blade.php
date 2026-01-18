@extends('layouts.app')

@section('title', 'Detail Penyaluran')
@section('page-title', 'Detail Penyaluran')

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
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Detail Laporan Penyaluran #{{ $penyaluran->id_penyaluran }}</h5>
            </div>
            <div class="card-body">
                <!-- Info Penyaluran -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3 fw-bold">Informasi Penyaluran</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th width="180">ID Penyaluran</th>
                                <td>: #{{ $penyaluran->id_penyaluran }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Penyaluran</th>
                                <td>: {{ $penyaluran->tanggal_penyaluran->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <td>: {{ $penyaluran->tanggal_penyaluran->format('H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <th>Volunteer</th>
                                <td>: {{ $penyaluran->volunteer ? $penyaluran->volunteer->nama_volunteer : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3 fw-bold">Program & Penerima</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th width="180">Program Bantuan</th>
                                <td>: {{ $penyaluran->programBantuan->nama_program ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Bantuan</th>
                                <td>: <span class="badge bg-info">{{ $penyaluran->programBantuan->jenis_bantuan ?? '-' }}</span></td>
                            </tr>
                            <tr>
                                <th>Korban</th>
                                <td>: {{ $penyaluran->korban->nama_korban ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Bencana</th>
                                <td>: <span class="badge bg-warning">{{ $penyaluran->korban->jenis_bencana ?? '-' }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <!-- Jumlah dan Lokasi -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-success bg-opacity-10 border-success">
                            <div class="card-body text-center">
                                <h6 class="text-muted mb-2">Jumlah Bantuan Disalurkan</h6>
                                <h2 class="text-success fw-bold mb-0">
                                    Rp {{ number_format($penyaluran->jumlah_disalurkan ?? 0, 0, ',', '.') }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-info bg-opacity-10 border-info">
                            <div class="card-body">
                                <h6 class="text-muted mb-2"><i class="bi bi-geo-alt"></i> Lokasi Penyaluran</h6>
                                <p class="mb-0 fw-semibold">{{ $penyaluran->korban->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="mb-4">
                    <h6 class="text-muted mb-2 fw-bold">Keterangan Penyaluran:</h6>
                    <div class="alert alert-light border">
                        {{ $penyaluran->keterangan ?? 'Tidak ada keterangan' }}
                    </div>
                </div>

                <!-- Foto Dokumentasi -->
                @if($penyaluran->foto_bukti || $penyaluran->foto_penyaluran)
                <div class="mb-4">
                    <h6 class="text-muted mb-2 fw-bold">Dokumentasi Penyaluran:</h6>
                    @if($penyaluran->foto_bukti)
                        <img src="{{ asset('uploads/penyaluran/' . $penyaluran->foto_bukti) }}" 
                             alt="Foto Bukti" class="img-fluid rounded border shadow-sm mb-2" style="max-width: 600px;">
                    @endif
                    @if($penyaluran->foto_penyaluran)
                        <img src="{{ asset('uploads/penyaluran/' . $penyaluran->foto_penyaluran) }}" 
                             alt="Foto Penyaluran" class="img-fluid rounded border shadow-sm" style="max-width: 600px;">
                    @endif
                </div>
                @endif

                <!-- Timestamp -->
                <div class="mb-4">
                    <small class="text-muted">
                        <i class="bi bi-clock"></i> Dibuat pada: {{ $penyaluran->created_at->format('d F Y, H:i') }} WIB
                        @if($penyaluran->updated_at != $penyaluran->created_at)
                            | Diupdate: {{ $penyaluran->updated_at->format('d F Y, H:i') }} WIB
                        @endif
                    </small>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between gap-2">
                    <a href="{{ route('admin.penyaluran.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.penyaluran.edit', $penyaluran->id_penyaluran) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
