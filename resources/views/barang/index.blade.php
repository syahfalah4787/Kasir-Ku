@extends('layouts.app')

@section('title', 'Data Barang')
@section('page-title', 'Data Barang')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 fw-bold">Daftar Barang</h5>
                    <a href="{{ route('barang.create') }}" class="btn btn-primary rounded-3 px-4">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Barang
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 ps-4 border-0 rounded-start" width="5%">No</th>
                                <th class="py-3 border-0">Nama Barang</th>
                                <th class="py-3 border-0">Kategori</th>
                                <th class="py-3 border-0">Harga</th>
                                <th class="py-3 border-0">Stok</th>
                                <th class="py-3 pe-4 border-0 rounded-end text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barang as $index => $item)
                            <tr>
                                <td class="ps-4 fw-semibold text-secondary">{{ $index + 1 }}</td>
                                <td class="fw-medium">{{ $item->nama_barang }}</td>
                                <td>
                                    <span class="badge bg-light text-secondary border">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($item->stok > 10)
                                        <span class="text-success fw-medium">{{ $item->stok }}</span>
                                    @elseif($item->stok > 0)
                                        <span class="text-warning fw-medium">{{ $item->stok }}</span>
                                    @else
                                        <span class="text-danger fw-medium">Habis</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $item->id_barang) }}" method="POST">
                                        <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-sm btn-soft-warning me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-soft-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-box-seam display-4 mb-2 opacity-50"></i>
                                        <p class="mb-0">Belum ada data barang.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-soft-warning {
        background-color: rgba(255, 193, 7, 0.15);
        color: #d97706;
        border: none;
    }
    .btn-soft-warning:hover {
        background-color: rgba(255, 193, 7, 0.25);
        color: #b45309;
    }
    .btn-soft-danger {
        background-color: rgba(220, 53, 69, 0.15);
        color: #dc3545;
        border: none;
    }
    .btn-soft-danger:hover {
        background-color: rgba(220, 53, 69, 0.25);
        color: #b02a37;
    }
</style>
@endsection
