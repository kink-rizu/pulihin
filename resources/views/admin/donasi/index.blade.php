@extends('layouts.app')

@section('title', 'Data Donasi')
@section('page-title', 'Data Donasi')

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
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-cash-coin"></i> Daftar Donasi</h5>
    </div>
    <div class="card-body">
        <!-- Filter -->
        <div class="row mb-3">
            <div class="col-md-3">
                <select class="form-select" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="berhasil">Berhasil</option>
                    <option value="gagal">Gagal</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Donatur</th>
                        <th>Program</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donasis as $index => $donasi)
                    <tr>
                        <td>{{ $donasis->firstItem() + $index }}</td>
                        <td>{{ $donasi->tanggal_donasi->format('d M Y') }}</td>
                        <td>
                            <div class="fw-semibold">{{ $donasi->donatur->nama_donatur }}</div>
                            <small class="text-muted">{{ $donasi->donatur->email }}</small>
                        </td>
                        <td>{{ Str::limit($donasi->programBantuan->nama_program, 30) }}</td>
                        <td><span class="badge bg-info">{{ ucfirst($donasi->jenis_donasi) }}</span></td>
                        <td class="fw-bold text-success">Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</td>
                        <td>
                            @if($donasi->status_pembayaran == 'berhasil')
                                <span class="badge bg-success">Berhasil</span>
                            @elseif($donasi->status_pembayaran == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.donasi.show', $donasi->id_donasi) }}" class="btn btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($donasi->status_pembayaran == 'pending')
                                    <form action="{{ route('admin.donasi.verify', $donasi->id_donasi) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success" title="Verifikasi" onclick="return confirm('Verifikasi donasi ini?')">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.donasi.reject', $donasi->id_donasi) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning" title="Tolak" onclick="return confirm('Tolak donasi ini?')">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.donasi.destroy', $donasi->id_donasi) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3"></i>
                            <p class="mb-0 mt-2">Belum ada donasi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $donasis->links() }}
    </div>
</div>
@endsection
