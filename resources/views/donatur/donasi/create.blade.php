@extends('layouts.app')

@section('title', 'Donasi')
@section('page-title', 'Form Donasi')

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
        <!-- Info Program -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $program->nama_program }}</h5>
                <p class="text-muted">{{ $program->keterangan }}</p>
                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <small class="text-muted">Jenis Bantuan</small>
                        <p class="fw-semibold"><span class="badge bg-primary">{{ $program->jenis_bantuan }}</span></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Dana Terkumpul</small>
                        <p class="fw-semibold text-success">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Target Dana</small>
                        <p class="fw-semibold">Rp {{ number_format($program->target_dana, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-success" style="width: {{ min($program->persentase_dana_terkumpul, 100) }}%"></div>
                </div>
                <small class="text-muted">{{ number_format($program->persentase_dana_terkumpul, 1) }}% Tercapai</small>
            </div>
        </div>

        <!-- Form Donasi -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-heart-fill text-danger"></i> Isi Data Donasi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('donatur.donasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_program" value="{{ $program->id_program }}">

                    <div class="mb-3">
                        <label for="jenis_donasi" class="form-label fw-semibold">Jenis Donasi <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_donasi') is-invalid @enderror" id="jenis_donasi" name="jenis_donasi" required>
                            <option value="">Pilih Jenis Donasi...</option>
                            <option value="tunai" {{ old('jenis_donasi') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="barang" {{ old('jenis_donasi') == 'barang' ? 'selected' : '' }}>Barang</option>
                        </select>
                        @error('jenis_donasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_donasi" class="form-label fw-semibold">Jumlah Donasi (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control @error('jumlah_donasi') is-invalid @enderror" 
                                id="jumlah_donasi" name="jumlah_donasi" value="{{ old('jumlah_donasi') }}" 
                                placeholder="Masukkan nominal donasi" min="10000" step="1000" required>
                        </div>
                        @error('jumlah_donasi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal donasi Rp 10.000</small>

                        <!-- Quick Amount Buttons -->
                        <div class="mt-2">
                            <small class="text-muted d-block mb-2">Nominal Cepat:</small>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="setAmount(50000)">50K</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="setAmount(100000)">100K</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="setAmount(250000)">250K</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="setAmount(500000)">500K</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="setAmount(1000000)">1Jt</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-select @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="">Pilih Metode Pembayaran...</option>
                            <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet (GoPay, OVO, Dana)</option>
                            <option value="QRIS" {{ old('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            <option value="Tunai" {{ old('metode_pembayaran') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                        </select>
                        @error('metode_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="bank-info" class="alert alert-info" style="display: none;">
                        <h6 class="fw-bold mb-2"><i class="bi bi-bank"></i> Informasi Rekening:</h6>
                        <ul class="mb-0">
                            <li>Bank BCA: <strong>1234567890</strong> a.n. Rizqi</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label fw-semibold">Bukti Transfer</label>
                        <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" 
                            id="bukti_transfer" name="bukti_transfer" accept="image/*">
                        @error('bukti_transfer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Upload bukti transfer (JPG, PNG, max 2MB)</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="anonim" name="anonim" value="1" {{ old('anonim') ? 'checked' : '' }}>
                            <label class="form-check-label" for="anonim">
                                Sembunyikan identitas saya (Donasi Anonim)
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="pesan" class="form-label fw-semibold">Pesan/Doa (Opsional)</label>
                        <textarea class="form-control @error('pesan') is-invalid @enderror" 
                            id="pesan" name="pesan" rows="3" placeholder="Tulis pesan atau doa untuk penerima bantuan...">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Total Donasi:</h5>
                        <h3 class="text-success mb-0 fw-bold" id="total-display">Rp 0</h3>
                    </div>

                    <div class="d-flex justify-content-between gap-2">
                        <a href="{{ route('donatur.program.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            <i class="bi bi-heart-fill"></i> Donasi Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Set quick amount
function setAmount(amount) {
    document.getElementById('jumlah_donasi').value = amount;
    updateTotal();
}

// Update total display
function updateTotal() {
    const amount = document.getElementById('jumlah_donasi').value || 0;
    const total = parseInt(amount);
    document.getElementById('total-display').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Show bank info when transfer selected
document.getElementById('metode_pembayaran').addEventListener('change', function() {
    const bankInfo = document.getElementById('bank-info');
    if (this.value === 'Transfer Bank') {
        bankInfo.style.display = 'block';
    } else {
        bankInfo.style.display = 'none';
    }
});

// Update total on input change
document.getElementById('jumlah_donasi').addEventListener('input', updateTotal);

// Initial total update
updateTotal();
</script>
@endpush
