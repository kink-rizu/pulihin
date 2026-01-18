@extends('layouts.app')

@section('title', 'Tambah Korban')
@section('page-title', 'Tambah Data Korban')

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
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Data Korban</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.korban.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_korban" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_korban') is-invalid @enderror" 
                            id="nama_korban" name="nama_korban" value="{{ old('nama_korban') }}" required>
                        @error('nama_korban')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                            id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenis_bencana" class="form-label fw-semibold">Jenis Bencana <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_bencana') is-invalid @enderror" 
                                id="jenis_bencana" name="jenis_bencana" required>
                                <option value="">Pilih Jenis Bencana...</option>
                                <option value="Banjir" {{ old('jenis_bencana') == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                                <option value="Gempa Bumi" {{ old('jenis_bencana') == 'Gempa Bumi' ? 'selected' : '' }}>Gempa Bumi</option>
                                <option value="Tanah Longsor" {{ old('jenis_bencana') == 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                                <option value="Kebakaran" {{ old('jenis_bencana') == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                <option value="Tsunami" {{ old('jenis_bencana') == 'Tsunami' ? 'selected' : '' }}>Tsunami</option>
                                <option value="Gunung Meletus" {{ old('jenis_bencana') == 'Gunung Meletus' ? 'selected' : '' }}>Gunung Meletus</option>
                                <option value="Lainnya" {{ old('jenis_bencana') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_bencana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label fw-semibold">No. HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                            id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.korban.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
