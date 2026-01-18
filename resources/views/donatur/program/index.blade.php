@extends('layouts.app')

@section('title', 'Program Donasi')
@section('page-title', 'Program Donasi')

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
    @forelse($programs as $program)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title fw-bold">{{ $program->nama_program }}</h5>
                    @if($program->status == 'aktif')
                        <span class="badge bg-success">Aktif</span>
                    @endif
                </div>

                <p class="card-text text-muted">{{ Str::limit($program->keterangan, 100) }}</p>

                <div class="mb-3">
                    <small class="text-muted">Target Dana:</small>
                    <h4 class="text-primary mb-2">Rp {{ number_format($program->target_dana, 0, ',', '.') }}</h4>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Progress</small>
                        <small class="fw-bold">{{ number_format($program->persentase_dana_terkumpul, 1) }}%</small>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: {{ min($program->persentase_dana_terkumpul, 100) }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-success fw-bold">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</small>
                        <small class="text-muted">Terkumpul</small>
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted"><i class="bi bi-calendar"></i> {{ $program->tanggal_mulai->format('d M Y') }} - {{ $program->tanggal_selesai->format('d M Y') }}</small>
                </div>

                <div class="d-grid">
                    <a href="{{ route('donatur.donasi.create', $program->id_program) }}" class="btn btn-primary">
                        <i class="bi bi-heart-fill"></i> Donasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <i class="bi bi-inbox fs-1 text-muted"></i>
        <p class="text-muted mt-2">Belum ada program donasi aktif</p>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $programs->links() }}
</div>
@endsection
