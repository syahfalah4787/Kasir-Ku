@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('history') }}" class="btn btn-light rounded-circle me-3" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h5 class="mb-0 fw-bold">Detail Transaksi #{{ $transaksi->id_transaksi }}</h5>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-secondary ps-0" width="130">Tanggal</td>
                                <td class="fw-medium">: {{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary ps-0">Kasir</td>
                                <td class="fw-medium">: {{ $transaksi->user->nama ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-2">Barang</th>
                                <th class="py-2 text-center" width="15%">Jumlah</th>
                                <th class="py-2 text-end" width="25%">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detailTransaksi as $detail)
                            <tr>
                                <td>{{ $detail->barang->nama_barang ?? 'Barang dihapus' }}</td>
                                <td class="text-center">{{ $detail->jumlah }}</td>
                                <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="2" class="fw-bold text-end pe-3">Total</td>
                                <td class="fw-bold text-end">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
