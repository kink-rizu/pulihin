@extends('layouts.app')

@section('title', 'Detail Donasi')
@section('page-title', 'Detail Donasi')

@section('sidebar')
    <a href="{{ route('donatur.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('donatur.program.index') }}" class="nav-link">
        <i class="bi bi-calendar-event"></i> Program Donasi
    </a>
    <a href="#" class="nav-link active">
        <i class="bi bi-clock-history"></i> Riwayat Donasi
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-receipt"></i> Detail Donasi</h5>
                @if($donasi->status_pembayaran == 'berhasil')
                    <span class="badge bg-success fs-6">Berhasil</span>
                @elseif($donasi->status_pembayaran == 'pending')
                    <span class="badge bg-warning fs-6">Menunggu Verifikasi</span>
                @else
                    <span class="badge bg-danger fs-6">Gagal</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Informasi Donasi</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th width="150">ID Donasi</th>
                                <td>: #{{ $donasi->id_donasi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>: {{ $donasi->tanggal_donasi->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <th>Program</th>
                                <td>: {{ $donasi->programBantuan->nama_program }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Donasi</th>
                                <td>: <span class="badge bg-info">{{ ucfirst($donasi->jenis_donasi) }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Detail Pembayaran</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th width="150">Jumlah Donasi</th>
                                <td>: <span class="fw-bold text-success fs-5">Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</span></td>
                            </tr>
                            <tr>
                                <th>Metode</th>
                                <td>: {{ $donasi->metode_pembayaran }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>: 
                                    @if($donasi->status_pembayaran == 'berhasil')
                                        <span class="badge bg-success">Berhasil</span>
                                    @elseif($donasi->status_pembayaran == 'pending')
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($donasi->pesan)
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Pesan/Doa:</h6>
                    <div class="alert alert-light border">
                        <i class="bi bi-quote"></i> {{ $donasi->pesan }}
                    </div>
                </div>
                @endif

                @if($donasi->bukti_transfer)
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Bukti Transfer:</h6>
                    <img src="{{ asset('uploads/bukti_transfer/' . $donasi->bukti_transfer) }}" 
                         alt="Bukti Transfer" class="img-fluid rounded border" style="max-width: 400px;">
                </div>
                @endif

                @if($donasi->status_pembayaran == 'pending')
                <div class="alert alert-warning">
                    <i class="bi bi-info-circle"></i> 
                    Donasi Anda sedang dalam proses verifikasi oleh admin. Harap tunggu konfirmasi lebih lanjut.
                </div>
                @endif

                @if($donasi->status_pembayaran == 'berhasil')
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> 
                    Terima kasih atas donasi Anda! Semoga menjadi berkah dan membantu sesama yang membutuhkan.
                </div>
                @endif

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('donatur.dashboard') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    @if($donasi->status_pembayaran == 'berhasil')
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="bi bi-printer"></i> Cetak Bukti
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
