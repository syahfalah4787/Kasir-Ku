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
    .history-table tbody tr {
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .history-table tbody tr:hover {
        background-color: #f9fafb;
    }
    .history-table tbody tr.selected {
        background-color: #eff6ff;
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
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 0.85rem;
        color: #3b82f6;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .pagination-btn:hover {
        background-color: #eff6ff;
        border-color: #3b82f6;
    }
    .pagination-btn[disabled] {
        color: #9ca3af;
        border-color: #e5e7eb;
        cursor: not-allowed;
    }
    .pagination-numbers {
        display: flex;
        gap: 4px;
        align-items: center;
    }
    .page-number {
        background-color: white;
        border: 1px solid #d1d5db;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.85rem;
        color: #3b82f6;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 32px;
        text-align: center;
        text-decoration: none;
    }
    .page-number:hover {
        background-color: #eff6ff;
        border-color: #3b82f6;
    }
    .page-number.active {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: white;
        font-weight: 500;
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
        display: none;
    }
    .detail-card.show {
        display: block;
    }
    .detail-placeholder {
        background: white;
        border-radius: 12px;
        padding: 60px 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        text-align: center;
        color: #9ca3af;
    }
    .detail-placeholder i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.5;
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
<form action="{{ route('history') }}" method="GET" class="filter-bar">
    <span class="filter-label">Filter:</span>
    <div class="filter-input">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control" placeholder="Start Date">
        <span class="mx-2">-</span>
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control" placeholder="End Date">
    </div>
    <button type="submit" class="btn-filter">Filter</button>
    @if(request('start_date'))
        <a href="{{ route('history') }}" class="btn btn-secondary" style="margin-left: 10px; text-decoration: none; color: #6b7280;">Reset</a>
    @endif
</form>

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
                <tbody id="transactionTable">
                    @forelse ($transaksi as $index => $item)
                    <tr class="transaction-row" 
                        data-invoice="#INV-{{ $item->id_transaksi }}" 
                        data-date="{{ $item->tanggal_transaksi->format('d-m-Y') }}" 
                        data-total="Rp {{ number_format($item->total_harga, 0, ',', '.') }}" 
                        data-customer="{{ $item->user->nama ?? 'Umum' }}" 
                        data-cashier="{{ $item->user->nama ?? '-' }}"
                        data-details="{{ json_encode($item->detailTransaksi->map(function($detail) {
                            return [
                                'name' => $detail->barang->nama_barang ?? 'Barang dihapus',
                                'price' => number_format($detail->barang->harga ?? 0, 0, ',', '.'),
                                'qty' => $detail->jumlah,
                                'subtotal' => number_format($detail->subtotal, 0, ',', '.')
                            ];
                        })) }}"
                    >
                        <td>{{ $transaksi->firstItem() + $index }}</td>
                        <td class="invoice-number">#INV-{{ $item->id_transaksi }}</td>
                        <td>{{ $item->tanggal_transaksi->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Belum ada riwayat transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Custom Pagination -->
            @if ($transaksi->hasPages())
            <div class="pagination-bar">
                <!-- Previous Button -->
                @if ($transaksi->onFirstPage())
                    <button class="pagination-btn" disabled>Previous</button>
                @else
                    <a href="{{ $transaksi->previousPageUrl() }}" class="pagination-btn">Previous</a>
                @endif

                <div class="pagination-numbers">
                    @foreach ($transaksi->getUrlRange(1, $transaksi->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="page-number {{ $page == $transaksi->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endforeach
                </div>

                <!-- Next Button -->
                @if ($transaksi->hasMorePages())
                    <a href="{{ $transaksi->nextPageUrl() }}" class="pagination-btn">Next</a>
                @else
                    <button class="pagination-btn" disabled>Next</button>
                @endif
            </div>
            @endif
        </div>
    </div>


    <!-- Detail Section -->
    <div class="detail-section">
        <!-- Placeholder (shown when no transaction is selected) -->
        <div class="detail-placeholder" id="detailPlaceholder">
            <i class="bi bi-receipt"></i>
            <p>Pilih transaksi untuk melihat detail</p>
        </div>

        <!-- Detail Card (shown when transaction is selected) -->
        <div class="detail-card" id="detailCard">
            <h3 class="detail-title">Detail Penjualan</h3>
            
            <div class="detail-row">
                <span class="detail-label">Nama Pelanggan</span>
                <span class="detail-value" id="detailCustomer">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">No.Invoice</span>
                <span class="detail-value" id="detailInvoice">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal</span>
                <span class="detail-value" id="detailDate">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Belanja</span>
                <span class="detail-value" id="detailTotal">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Petugas Kasir</span>
                <span class="detail-value" id="detailCashier">-</span>
            </div>

            <div class="items-list" id="detailItems">
                <!-- Items will be populated by JS -->
            </div>
        </div>
    </div>
</div>

<script>
    // Get all transaction rows
    const transactionRows = document.querySelectorAll('.transaction-row');
    const detailCard = document.getElementById('detailCard');
    const detailPlaceholder = document.getElementById('detailPlaceholder');
    const detailItems = document.getElementById('detailItems');
    
    // Add click event to each row
    transactionRows.forEach(row => {
        row.addEventListener('click', function() {
            // Remove selected class from all rows
            transactionRows.forEach(r => r.classList.remove('selected'));
            
            // Add selected class to clicked row
            this.classList.add('selected');
            
            // Get data from row
            const invoice = this.dataset.invoice;
            const date = this.dataset.date;
            const total = this.dataset.total;
            const customer = this.dataset.customer;
            const cashier = this.dataset.cashier;
            const details = JSON.parse(this.dataset.details);
            
            // Update detail card
            document.getElementById('detailInvoice').textContent = invoice;
            document.getElementById('detailDate').textContent = date;
            document.getElementById('detailTotal').textContent = total;
            document.getElementById('detailCustomer').textContent = customer;
            document.getElementById('detailCashier').textContent = cashier;
            
            // Populate items
            detailItems.innerHTML = '';
            details.forEach(item => {
                detailItems.innerHTML += `
                    <div class="item-row">
                        <div class="item-name">${item.name}</div>
                        <div class="item-details">
                            <div class="item-price">Rp. ${item.price}</div>
                            <div class="item-qty">qty: ${item.qty}x &nbsp; Rp ${item.subtotal}</div>
                        </div>
                    </div>
                `;
            });

            // Show detail card, hide placeholder
            detailPlaceholder.style.display = 'none';
            detailCard.classList.add('show');
        });
    });
</script>
@endsection

