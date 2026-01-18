@extends('layouts.app')

@section('title', 'Riwayat Bantuan')
@section('page-title', 'Riwayat Bantuan Saya')

@section('sidebar')
    <a href="{{ route('korban.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('korban.bantuan.index') }}" class="nav-link active">
        <i class="bi bi-box-seam"></i> Riwayat Bantuan
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-box-seam"></i> Riwayat Bantuan yang Diterima
        </h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Program Bantuan</th>
                        <th>Jenis Bantuan</th>
                        <th>Volunteer</th>
                        <th>Jumlah / Nilai Bantuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bantuan as $index => $penyaluran)
                    <tr>
                        <td>{{ $bantuan->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-semibold">
                                {{ $penyaluran->tanggal_penyaluran->format('d M Y') }}
                            </div>
                            <small class="text-muted">
                                {{ $penyaluran->tanggal_penyaluran->format('H:i') }} WIB
                            </small>
                        </td>
                        <td>
                            <div class="fw-semibold">
                                {{ $penyaluran->programBantuan->nama_program }}
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">
                                {{ $penyaluran->programBantuan->jenis_bantuan }}
                            </span>
                        </td>
                        <td>
                            {{ $penyaluran->volunteer ? $penyaluran->volunteer->nama_volunteer : '-' }}
                        </td>
                        <td class="fw-bold text-success">
                            Rp {{ number_format($penyaluran->jumlah_disalurkan, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3"></i>
                            <p class="mb-0 mt-2">
                                Belum ada riwayat bantuan yang tercatat untuk akun Anda.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($bantuan->hasPages())
    <div class="card-footer bg-white">
        {{ $bantuan->links() }}
    </div>
    @endif
</div>
@endsection
