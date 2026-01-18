@extends('layouts.app')

@section('title', 'Daftar Kebutuhan')
@section('page-title', 'Daftar Kebutuhan Saya')

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
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-list-check"></i> Daftar Kebutuhan</h5>
        <a href="{{ route('korban.kebutuhan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kebutuhan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Kebutuhan</th>
                        <th>Jumlah</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kebutuhans as $index => $item)
                    <tr>
                        <td>{{ $kebutuhans->firstItem() + $index }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                            </span>
                        </td>
                        <td class="fw-semibold">{{ $item->nama_kebutuhan }}</td>
                        <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                        <td>
                            @if($item->prioritas == 'tinggi')
                                <span class="badge bg-danger">Tinggi</span>
                            @elseif($item->prioritas == 'sedang')
                                <span class="badge bg-warning">Sedang</span>
                            @else
                                <span class="badge bg-info">Rendah</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'terpenuhi')
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Terpenuhi</span>
                            @elseif($item->status == 'terpenuhi_sebagian')
                                <span class="badge bg-warning"><i class="bi bi-hourglass-split"></i> Sebagian</span>
                            @else
                                <span class="badge bg-secondary"><i class="bi bi-clock"></i> Dibutuhkan</span>
                            @endif
                        </td>
                        <td><small>{{ Str::limit($item->keterangan ?? '-', 40) }}</small></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('korban.kebutuhan.edit', $item->id_kebutuhan) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('korban.kebutuhan.destroy', $item->id_kebutuhan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
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
                            <p class="mb-0 mt-2">Belum ada kebutuhan yang terdaftar</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $kebutuhans->links() }}
    </div>
</div>
@endsection
