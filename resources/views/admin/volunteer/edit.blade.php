@extends('layouts.app')

@section('title', 'Edit Volunteer')
@section('page-title', 'Edit Volunteer')

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
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Data Volunteer</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.volunteer.update', $volunteer->id_volunteer) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_volunteer" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_volunteer') is-invalid @enderror" 
                            id="nama_volunteer" name="nama_volunteer" value="{{ old('nama_volunteer', $volunteer->nama_volunteer) }}" required>
                        @error('nama_volunteer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                            id="alamat" name="alamat" rows="3" required>{{ old('alamat', $volunteer->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email', $volunteer->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label fw-semibold">No. HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                id="no_hp" name="no_hp" value="{{ old('no_hp', $volunteer->no_hp) }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="aktif" {{ old('status', $volunteer->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $volunteer->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.volunteer.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
