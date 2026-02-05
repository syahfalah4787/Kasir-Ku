@extends('layouts.app')

@section('title', 'Transaksi')
@section('page-title', 'Transaksi')

@section('styles')
<style>
    .transaksi-container {
        display: flex;
        gap: 25px;
        align-items: flex-start;
    }
    .product-section {
        flex: 1;
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .cart-section {
        width: 380px;
        flex-shrink: 0;
    }
    .search-bar {
        position: relative;
        margin-bottom: 25px;
    }
    .search-bar input {
        width: 100%;
        padding: 12px 16px 12px 45px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        background-color: #f9fafb;
    }
    .search-bar input:focus {
        outline: none;
        border-color: #3b82f6;
        background-color: white;
    }
    .search-bar i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.1rem;
    }
    .product-table {
        width: 100%;
        border-collapse: collapse;
    }
    .product-table thead th {
        text-align: left;
        padding: 14px 12px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #f3f4f6;
    }
    .product-table tbody td {
        padding: 16px 12px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.9rem;
        color: #1f2937;
    }
    .product-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
    }
    .btn-add {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-add:hover {
        background-color: #059669;
    }
    .cart-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .cart-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
    }
    .cart-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .cart-item:last-child {
        border-bottom: none;
    }
    .cart-item-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
    }
    .cart-item-info {
        flex: 1;
    }
    .cart-item-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 4px;
    }
    .cart-item-qty {
        font-size: 0.8rem;
        color: #6b7280;
    }
    .cart-item-price {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1f2937;
        text-align: right;
    }
    .btn-remove {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-remove:hover {
        background-color: #dc2626;
    }
    .payment-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .payment-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
    }
    .payment-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.9rem;
    }
    .payment-label {
        color: #6b7280;
    }
    .payment-value {
        font-weight: 600;
        color: #1f2937;
    }
    .payment-total {
        padding-top: 12px;
        margin-top: 12px;
        border-top: 2px solid #f3f4f6;
    }
    .payment-total .payment-label {
        font-weight: 600;
        color: #1f2937;
    }
    .payment-total .payment-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
    }
    .btn-checkout {
        width: 100%;
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 14px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        transition: background-color 0.2s;
    }
    .btn-checkout:hover {
        background-color: #2563eb;
    }
</style>
@endsection

@section('content')
<div class="transaksi-container">
    <!-- Product Section -->
    <div class="product-section">
        <!-- Search Bar -->
        <div class="search-bar">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari Produk">
        </div>

        <!-- Product Table -->
        <table class="product-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 8; $i++)
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="https://via.placeholder.com/50x50/ff6b6b/ffffff?text=Indomie" alt="Indomie" class="product-img">
                            <span>Indomie</span>
                        </div>
                    </td>
                    <td>Rp.7.000</td>
                    <td>89</td>
                    <td>
                        <button class="btn-add">Tambah</button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <!-- Cart & Payment Section -->
    <div class="cart-section">
        <!-- Cart -->
        <div class="cart-card">
            <h3 class="cart-title">Keranjang</h3>
            @for ($i = 0; $i < 3; $i++)
            <div class="cart-item">
                <img src="https://via.placeholder.com/45x45/ff6b6b/ffffff?text=I" alt="Indomie" class="cart-item-img">
                <div class="cart-item-info">
                    <div class="cart-item-name">Indomie</div>
                    <div class="cart-item-qty">2x @ 3.500</div>
                </div>
                <div class="cart-item-price">Rp.7.000</div>
                <button class="btn-remove">Hapus</button>
            </div>
            @endfor
        </div>

        <!-- Payment Summary -->
        <div class="payment-card">
            <h3 class="payment-title">Total Pembayaran</h3>
            <div class="payment-row">
                <span class="payment-label">Subtotal</span>
                <span class="payment-value">Rp.7.000</span>
            </div>
            <div class="payment-row">
                <span class="payment-label">Pajak</span>
                <span class="payment-value">Rp.1.500</span>
            </div>
            <div class="payment-row payment-total">
                <span class="payment-label">Total</span>
                <span class="payment-value">Rp.8.500</span>
            </div>
            <button class="btn-checkout">Proses Pembayaran</button>
        </div>
    </div>
</div>
@endsection
