@extends('layouts.app')

@section('title', 'Tambah Program Bantuan')
@section('page-title', 'Tambah Program Bantuan')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('admin.program.index') }}" class="nav-link active">
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
    <a href="{{ route('admin.penyaluran.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Penyaluran
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Program Bantuan Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.program.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nama_program" class="form-label fw-semibold">Nama Program <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_program') is-invalid @enderror" 
                            id="nama_program" name="nama_program" value="{{ old('nama_program') }}" required>
                        @error('nama_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenis_bantuan" class="form-label fw-semibold">Jenis Bantuan <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_bantuan') is-invalid @enderror" 
                                id="jenis_bantuan" name="jenis_bantuan" required>
                                <option value="">Pilih Jenis...</option>
                                <option value="Tunai" {{ old('jenis_bantuan') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                <option value="Sembako" {{ old('jenis_bantuan') == 'Sembako' ? 'selected' : '' }}>Sembako</option>
                                <option value="Pakaian" {{ old('jenis_bantuan') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="Obat-obatan" {{ old('jenis_bantuan') == 'Obat-obatan' ? 'selected' : '' }}>Obat-obatan</option>
                                <option value="Tempat Tinggal" {{ old('jenis_bantuan') == 'Tempat Tinggal' ? 'selected' : '' }}>Tempat Tinggal</option>
                                <option value="Lainnya" {{ old('jenis_bantuan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_bantuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="target_dana" class="form-label fw-semibold">Target Dana (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('target_dana') is-invalid @enderror" 
                                id="target_dana" name="target_dana" value="{{ old('target_dana') }}" min="0" required>
                            @error('target_dana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_mulai" class="form-label fw-semibold">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_selesai" class="form-label fw-semibold">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                            id="keterangan" name="keterangan" rows="4">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.program.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Program
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
