@extends('layouts.app')

@section('title', 'Buat Donasi')
@section('page-title', 'Buat Donasi')

@section('sidebar')
    <a href="{{ route('donatur.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('donatur.program.index') }}" class="nav-link active">
        <i class="bi bi-calendar-event"></i> Program Donasi
    </a>
    <a href="#" class="nav-link">
        <i class="bi bi-clock-history"></i> Riwayat Donasi
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-heart-fill"></i> Form Donasi</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Program:</strong> {{ $program->nama_program }}<br>
                    <strong>Target Dana:</strong> Rp {{ number_format($program->target_dana, 0, ',', '.') }}<br>
                    <strong>Dana Terkumpul:</strong> Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}
                </div>

                <form action="{{ route('donatur.donasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_program" value="{{ $program->id_program }}">

                    <div class="mb-3">
                        <label for="jenis_donasi" class="form-label fw-semibold">Jenis Donasi <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_donasi') is-invalid @enderror" id="jenis_donasi" name="jenis_donasi" required>
                            <option value="">Pilih Jenis...</option>
                            <option value="tunai" {{ old('jenis_donasi') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="barang" {{ old('jenis_donasi') == 'barang' ? 'selected' : '' }}>Barang</option>
                        </select>
                        @error('jenis_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_donasi" class="form-label fw-semibold">Jumlah Donasi (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-lg @error('jumlah_donasi') is-invalid @enderror" 
                            id="jumlah_donasi" name="jumlah_donasi" value="{{ old('jumlah_donasi') }}" min="10000" placeholder="Minimal Rp 10.000" required>
                        @error('jumlah_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal donasi Rp 10.000</small>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label fw-semibold">Bukti Transfer (opsional)</label>
                        <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" 
                            id="bukti_transfer" name="bukti_transfer" accept="image/*">
                        @error('bukti_transfer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                    </div>

                    <div class="alert alert-warning">
                        <strong>Informasi Rekening Transfer:</strong><br>
                        Bank BCA: 1234567890 a.n. Rizqi <br>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('donatur.program.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-heart-fill"></i> Kirim Donasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
