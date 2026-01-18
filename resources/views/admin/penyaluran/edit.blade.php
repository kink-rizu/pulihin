@extends('layouts.app')

@section('title', 'Edit Penyaluran')
@section('page-title', 'Edit Penyaluran')

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
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Data Penyaluran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.penyaluran.update', $penyaluran->id_penyaluran) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_program" class="form-label fw-semibold">Program Bantuan <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_program') is-invalid @enderror" id="id_program" name="id_program" required>
                            <option value="">Pilih Program Bantuan...</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id_program }}" 
                                    {{ old('id_program', $penyaluran->id_program) == $program->id_program ? 'selected' : '' }}>
                                    {{ $program->nama_program }} - {{ $program->jenis_bantuan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_korban" class="form-label fw-semibold">Korban Penerima <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_korban') is-invalid @enderror" id="id_korban" name="id_korban" required>
                            <option value="">Pilih Korban Penerima...</option>
                            @foreach($korbans as $korban)
                                <option value="{{ $korban->id_korban }}" 
                                    {{ old('id_korban', $penyaluran->id_korban) == $korban->id_korban ? 'selected' : '' }}>
                                    {{ $korban->nama_korban }} - {{ $korban->jenis_bencana }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_korban')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_volunteer" class="form-label fw-semibold">Volunteer</label>
                        <select class="form-select @error('id_volunteer') is-invalid @enderror" id="id_volunteer" name="id_volunteer">
                            <option value="">Pilih Volunteer (Opsional)...</option>
                            @foreach($volunteers as $volunteer)
                                <option value="{{ $volunteer->id_volunteer }}" 
                                    {{ old('id_volunteer', $penyaluran->id_volunteer) == $volunteer->id_volunteer ? 'selected' : '' }}>
                                    {{ $volunteer->nama_volunteer }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_volunteer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_penyaluran" class="form-label fw-semibold">Tanggal Penyaluran <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_penyaluran') is-invalid @enderror" 
                                id="tanggal_penyaluran" name="tanggal_penyaluran" 
                                value="{{ old('tanggal_penyaluran', $penyaluran->tanggal_penyaluran->format('Y-m-d')) }}" required>
                            @error('tanggal_penyaluran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jumlah_disalurkan" class="form-label fw-semibold">Jumlah Disalurkan (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('jumlah_disalurkan') is-invalid @enderror" 
                                    id="jumlah_disalurkan" name="jumlah_disalurkan" 
                                    value="{{ old('jumlah_disalurkan', $penyaluran->jumlah_disalurkan) }}" 
                                    placeholder="0" min="1000" step="1000" required>
                            </div>
                            @error('jumlah_disalurkan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                            id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan', $penyaluran->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto_penyaluran" class="form-label fw-semibold">Foto Penyaluran</label>
                        
                        @if($penyaluran->foto_penyaluran)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/penyaluran/' . $penyaluran->foto_penyaluran) }}" 
                                 alt="Foto Saat Ini" class="img-thumbnail" style="max-width: 200px;">
                            <p class="text-muted small mb-0">Foto saat ini</p>
                        </div>
                        @endif
                        
                        <input type="file" class="form-control @error('foto_penyaluran') is-invalid @enderror" 
                            id="foto_penyaluran" name="foto_penyaluran" accept="image/*">
                        @error('foto_penyaluran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Upload foto baru jika ingin mengganti</small>
                    </div>

                    <div class="d-flex justify-content-between gap-2">
                        <a href="{{ route('admin.penyaluran.show', $penyaluran->id_penyaluran) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-save"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
