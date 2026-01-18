@extends('layouts.app')

@section('title', 'Detail Donasi')
@section('page-title', 'Detail Donasi')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('admin.program.index') }}" class="nav-link">
        <i class="bi bi-calendar-event"></i> Program Bantuan
    </a>
    <a href="{{ route('admin.donasi.index') }}" class="nav-link active">
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
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Donasi</h5>
                @if($donasi->status_pembayaran == 'berhasil')
                    <span class="badge bg-success">Berhasil</span>
                @elseif($donasi->status_pembayaran == 'pending')
                    <span class="badge bg-warning">Pending</span>
                @else
                    <span class="badge bg-danger">Gagal</span>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">ID Donasi</th>
                        <td>: #{{ $donasi->id_donasi }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Donasi</th>
                        <td>: {{ $donasi->tanggal_donasi->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Nama Donatur</th>
                        <td>: {{ $donasi->donatur->nama_donatur }}</td>
                    </tr>
                    <tr>
                        <th>Email Donatur</th>
                        <td>: {{ $donasi->donatur->email }}</td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>: {{ $donasi->donatur->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Program</th>
                        <td>: {{ $donasi->programBantuan->nama_program }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Donasi</th>
                        <td>: <span class="badge bg-info">{{ ucfirst($donasi->jenis_donasi) }}</span></td>
                    </tr>
                    <tr>
                        <th>Jumlah Donasi</th>
                        <td>: <span class="fw-bold text-success fs-4">Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</span></td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>: 
                            @if($donasi->status_pembayaran == 'berhasil')
                                <span class="badge bg-success">Berhasil</span>
                            @elseif($donasi->status_pembayaran == 'pending')
                                <span class="badge bg-warning">Pending Verifikasi</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                        </td>
                    </tr>
                </table>

                @if($donasi->bukti_transfer)
                <div class="mt-4">
                    <h6 class="fw-bold">Bukti Transfer:</h6>
                    <img src="{{ asset('uploads/bukti_transfer/' . $donasi->bukti_transfer) }}" 
                         alt="Bukti Transfer" class="img-fluid rounded border" style="max-width: 500px;">
                </div>
                @endif

                <div class="d-flex gap-2 mt-4">
                    @if($donasi->status_pembayaran == 'pending')
                        <form action="{{ route('admin.donasi.verify', $donasi->id_donasi) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" onclick="return confirm('Verifikasi donasi ini?')">
                                <i class="bi bi-check-circle"></i> Verifikasi Donasi
                            </button>
                        </form>
                        <form action="{{ route('admin.donasi.reject', $donasi->id_donasi) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Tolak donasi ini?')">
                                <i class="bi bi-x-circle"></i> Tolak Donasi
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('admin.donasi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
