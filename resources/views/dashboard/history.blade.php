@extends('layouts.app')

@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('styles')
<style>
    .history-container {
        display: flex;
        gap: 25px;
    }
    .table-section {
        flex: 1;
    }
    .detail-section {
        width: 380px;
        flex-shrink: 0;
    }
    .filter-bar {
        background: white;
        padding: 18px 20px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .filter-label {
        font-weight: 600;
        color: #6b7280;
        font-size: 0.9rem;
    }
    .filter-input {
        flex: 1;
        max-width: 350px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background-color: white;
    }
    .filter-input input {
        border: none;
        outline: none;
        flex: 1;
        font-size: 0.9rem;
        color: #1f2937;
    }
    .filter-input i {
        color: #9ca3af;
    }
    .btn-filter {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 10px 28px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-filter:hover {
        background-color: #2563eb;
    }
    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .history-table {
        width: 100%;
        border-collapse: collapse;
    }
    .history-table thead th {
        background-color: #fafafa;
        text-align: left;
        padding: 16px 18px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #f3f4f6;
    }
    .history-table tbody td {
        padding: 16px 18px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.9rem;
        color: #1f2937;
    }
    .history-table tbody tr:hover {
        background-color: #f9fafb;
    }
    .invoice-number {
        font-weight: 600;
    }
    .pagination-bar {
        padding: 18px 20px;
        border-top: 1px solid #f3f4f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .pagination-btn {
        background-color: white;
        border: 1px solid #d1d5db;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
    }
    .pagination-btn:hover {
        background-color: #f9fafb;
        border-color: #9ca3af;
    }
    .pagination-numbers {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    .page-number {
        background-color: white;
        border: 1px solid #d1d5db;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 36px;
        text-align: center;
    }
    .page-number:hover {
        background-color: #f9fafb;
    }
    .page-number.active {
        background-color: #e5e7eb;
        border-color: #9ca3af;
        font-weight: 600;
    }
    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .detail-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f3f4f6;
    }
    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 14px;
        font-size: 0.9rem;
    }
    .detail-label {
        color: #6b7280;
    }
    .detail-value {
        color: #9ca3af;
        text-align: right;
        font-weight: 500;
    }
    .items-list {
        margin-top: 25px;
        max-height: 400px;
        overflow-y: auto;
    }
    .item-row {
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .item-row:last-child {
        border-bottom: none;
    }
    .item-name {
        font-weight: 500;
        color: #4b5563;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }
    .item-details {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
    }
    .item-price {
        color: #1f2937;
        font-weight: 600;
    }
    .item-qty {
        color: #1f2937;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<!-- Filter Bar -->
<div class="filter-bar">
    <span class="filter-label">Filter:</span>
    <div class="filter-input">
        <input type="text" value="01/02/2025 - 02/03/2026" readonly>
        <i class="bi bi-clock"></i>
    </div>
    <button class="btn-filter">Filter</button>
</div>

<div class="history-container">
    <!-- Table Section -->
    <div class="table-section">
        <div class="table-card">
            <table class="history-table">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>No.Invoice</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 18; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="invoice-number">#INV-02-01/02/2025</td>
                        <td>01-02-2025</td>
                        <td>94.000.00</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            <div class="pagination-bar">
                <button class="pagination-btn">Previous</button>
                <div class="pagination-numbers">
                    <button class="page-number active">1</button>
                    <button class="page-number">2</button>
                    <button class="page-number">3</button>
                    <span>...</span>
                    <button class="page-number">18</button>
                </div>
                <button class="pagination-btn">next</button>
            </div>
        </div>
    </div>

    <!-- Detail Section -->
    <div class="detail-section">
        <div class="detail-card">
            <h3 class="detail-title">Detail Penjualan</h3>
            
            <div class="detail-row">
                <span class="detail-label">Nama Pelanggan</span>
                <span class="detail-value">Anas Jayadi Saputra</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">No.Invoice</span>
                <span class="detail-value">#INV-02-01/02/2025</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal</span>
                <span class="detail-value">2025-02-01</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Belanja</span>
                <span class="detail-value">94.000.00</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Petugas Kasir</span>
                <span class="detail-value">Siti Mpruy</span>
            </div>

            <div class="items-list">
                @for ($j = 0; $j < 8; $j++)
                <div class="item-row">
                    <div class="item-name">Indomie Goreng Rebus</div>
                    <div class="item-details">
                        <div class="item-price">Rp. 3.500</div>
                        <div class="item-qty">qty: 28x &nbsp; Rp 54.000</div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
