@extends('layouts.app')

@section('title', 'Edit Kebutuhan')
@section('page-title', 'Edit Kebutuhan')

@section('sidebar')
    <a href="{{ route('korban.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('korban.kebutuhan.index') }}" class="nav-link active">
        <i class="bi bi-list-check"></i> Kebutuhan Saya
    </a>
    <a href="{{ route('korban.bantuan.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Riwayat Bantuan
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Kebutuhan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('korban.kebutuhan.update', $kebutuhan->id_kebutuhan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori...</option>
                                <option value="makanan" {{ old('kategori', $kebutuhan->kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="pakaian" {{ old('kategori', $kebutuhan->kategori) == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="obat-obatan" {{ old('kategori', $kebutuhan->kategori) == 'obat-obatan' ? 'selected' : '' }}>Obat-obatan</option>
                                <option value="tempat_tinggal" {{ old('kategori', $kebutuhan->kategori) == 'tempat_tinggal' ? 'selected' : '' }}>Tempat Tinggal</option>
                                <option value="lainnya" {{ old('kategori', $kebutuhan->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="prioritas" class="form-label fw-semibold">Prioritas <span class="text-danger">*</span></label>
                            <select class="form-select @error('prioritas') is-invalid @enderror" id="prioritas" name="prioritas" required>
                                <option value="">Pilih Prioritas...</option>
                                <option value="rendah" {{ old('prioritas', $kebutuhan->prioritas) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ old('prioritas', $kebutuhan->prioritas) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ old('prioritas', $kebutuhan->prioritas) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                            @error('prioritas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kebutuhan" class="form-label fw-semibold">Nama Kebutuhan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_kebutuhan') is-invalid @enderror" 
                            id="nama_kebutuhan" name="nama_kebutuhan" value="{{ old('nama_kebutuhan', $kebutuhan->nama_kebutuhan) }}" required>
                        @error('nama_kebutuhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                id="jumlah" name="jumlah" value="{{ old('jumlah', $kebutuhan->jumlah) }}" min="1" required>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="satuan" class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" 
                                id="satuan" name="satuan" value="{{ old('satuan', $kebutuhan->satuan) }}" required>
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="dibutuhkan" {{ old('status', $kebutuhan->status) == 'dibutuhkan' ? 'selected' : '' }}>Dibutuhkan</option>
                                <option value="terpenuhi_sebagian" {{ old('status', $kebutuhan->status) == 'terpenuhi_sebagian' ? 'selected' : '' }}>Terpenuhi Sebagian</option>
                                <option value="terpenuhi" {{ old('status', $kebutuhan->status) == 'terpenuhi' ? 'selected' : '' }}>Terpenuhi</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                            id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $kebutuhan->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('korban.kebutuhan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Update Kebutuhan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
