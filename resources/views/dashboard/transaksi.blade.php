@extends('layouts.app')

@section('title', 'Transaksi')
@section('page-title', 'Transaksi')

@section('styles')
<style>
    .transaksi-container {
        display: flex;
        gap: 25px;
        align-items: flex-start;
        height: calc(100vh - 140px); 
    }
    .product-section {
        flex: 1;
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
    }
    .cart-section {
        width: 380px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        gap: 20px;
        height: 100%;
    }
    .search-bar {
        position: relative;
        margin-bottom: 20px;
        flex-shrink: 0;
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
    .product-table-wrapper {
        flex: 1;
        overflow-y: auto;
    }
    .product-table {
        width: 100%;
        border-collapse: collapse;
    }
    .product-table thead {
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
        padding: 12px 12px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.9rem;
        color: #1f2937;
        vertical-align: middle;
    }
    .product-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .product-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #9ca3af;
    }
    .btn-add {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-add:hover {
        background-color: #059669;
    }
    .btn-add:disabled {
        background-color: #9ca3af;
        cursor: not-allowed;
    }
    
    /* Cart Styles */
    .cart-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .cart-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
        flex-shrink: 0;
    }
    .cart-items {
        flex: 1;
        overflow-y: auto;
        padding-right: 5px;
    }
    .cart-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #f3f4f6;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .cart-item:last-child {
        border-bottom: none;
    }
    .cart-item-info {
        flex: 1;
        min-width: 0;
    }
    .cart-item-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .cart-item-qty-control {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .qty-btn {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        border: 1px solid #d1d5db;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.8rem;
        color: #4b5563;
    }
    .qty-btn:hover {
        background: #f3f4f6;
    }
    .cart-item-qty {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1f2937;
        min-width: 20px;
        text-align: center;
    }
    .cart-item-price {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1f2937;
        text-align: right;
        min-width: 70px;
    }
    .btn-remove-item {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-remove-item:hover {
        background-color: #dc2626;
    }
    
    .payment-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
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
        font-size: 1.1rem;
    }
    .payment-total .payment-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #3b82f6;
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
    .btn-checkout:disabled {
        background-color: #9ca3af;
        cursor: person;
    }
    .empty-cart-msg {
        text-align: center;
        color: #9ca3af;
        margin-top: 50px;
    }
    .empty-cart-msg i {
        font-size: 3rem;
        margin-bottom: 10px;
        display: block;
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
            <input type="text" id="searchInput" placeholder="Cari Produk (Nama / ID)">
        </div>

        <!-- Product Table -->
        <div class="product-table-wrapper">
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    @foreach ($barangs as $barang)
                    <tr class="product-row" data-name="{{ strtolower($barang->nama_barang) }}">
                        <td>
                            <div class="product-info">
                                <div class="product-img">
                                    <i class="bi bi-box"></i>
                                </div>
                                <span>{{ $barang->nama_barang }}</span>
                            </div>
                        </td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>
                            <button class="btn-add" 
                                onclick="addToCart({{ $barang->id_barang }}, '{{ $barang->nama_barang }}', {{ $barang->harga }}, {{ $barang->stok }})"
                                {{ $barang->stok <= 0 ? 'disabled' : '' }}>
                                {{ $barang->stok <= 0 ? 'Habis' : 'Tambah' }}
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cart & Payment Section -->
    <div class="cart-section">
        <!-- Cart -->
        <div class="cart-card">
            <h3 class="cart-title">Keranjang</h3>
            <div class="cart-items" id="cartItems">
                <div class="empty-cart-msg">
                    <i class="bi bi-cart"></i>
                    Belum ada barang
                </div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="payment-card">
            <h3 class="payment-title">Pembayaran</h3>
            <div class="payment-row">
                <span class="payment-label">Subtotal</span>
                <span class="payment-value" id="subtotalValue">Rp 0</span>
            </div>
            <div class="payment-row">
                <span class="payment-label">Pajak (10%)</span>
                <span class="payment-value" id="taxValue">Rp 0</span>
            </div>
            <div class="payment-row payment-total">
                <span class="payment-label">Total</span>
                <span class="payment-value" id="totalValue">Rp 0</span>
            </div>
            <button class="btn-checkout" id="btnCheckout" onclick="processCheckout()" disabled>
                Proses Pembayaran
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let cart = [];
    
    // Search Filter
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('.product-row');
        
        rows.forEach(row => {
            const name = row.dataset.name;
            if(name.includes(value)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Format Rupiah
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }

    // Add to Cart
    function addToCart(id, name, price, maxStock) {
        const existingItem = cart.find(item => item.id === id);
        
        if (existingItem) {
            if (existingItem.qty < maxStock) {
                existingItem.qty++;
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Habis',
                    text: 'Jumlah melebihi stok tersedia',
                    timer: 1500,
                    showConfirmButton: false
                });
                return;
            }
        } else {
            cart.push({
                id: id,
                name: name,
                price: price,
                qty: 1,
                maxStock: maxStock
            });
        }
        
        renderCart();
    }

    // Update Qty
    function updateQty(id, change) {
        const item = cart.find(item => item.id === id);
        if(!item) return;

        const newQty = item.qty + change;
        
        if (newQty > item.maxStock) {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Terbatas',
                text: 'Jumlah melebihi stok tersedia',
                timer: 1500,
                showConfirmButton: false
            });
            return;
        }

        if (newQty <= 0) {
            confirmRemove(id);
        } else {
            item.qty = newQty;
            renderCart();
        }
    }

    function confirmRemove(id) {
        // Direct remove for simpler UX
        cart = cart.filter(item => item.id !== id);
        renderCart();
    }

    // Render Cart
    function renderCart() {
        const cartContainer = document.getElementById('cartItems');
        const btnCheckout = document.getElementById('btnCheckout');
        
        if (cart.length === 0) {
            cartContainer.innerHTML = `
                <div class="empty-cart-msg">
                    <i class="bi bi-cart"></i>
                    Belum ada barang
                </div>
            `;
            btnCheckout.disabled = true;
            document.getElementById('subtotalValue').textContent = formatRupiah(0);
            document.getElementById('taxValue').textContent = formatRupiah(0);
            document.getElementById('totalValue').textContent = formatRupiah(0);
            return;
        }

        let subtotal = 0;
        let html = '';

        cart.forEach(item => {
            const itemSubtotal = item.price * item.qty;
            subtotal += itemSubtotal;

            html += `
                <div class="cart-item">
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-qty-control">
                            <span class="cart-item-qty">${item.qty}x</span>
                            <span style="font-size: 0.8rem; color: #6b7280;">
                                <i class="bi bi-cash"></i> ${formatRupiah(item.price)}
                            </span>
                        </div>
                    </div>
                    <div class="cart-item-price">
                        ${formatRupiah(itemSubtotal)}
                    </div>
                    <button class="btn-remove-item" onclick="confirmRemove(${item.id})">
                        Hapus
                    </button>
                </div>
            `;
        });
        
        // Calculate Tax (10%)
        const tax = subtotal * 0.1;
        const total = subtotal + tax;

        cartContainer.innerHTML = html;
        document.getElementById('subtotalValue').textContent = formatRupiah(subtotal);
        document.getElementById('taxValue').textContent = formatRupiah(tax);
        document.getElementById('totalValue').textContent = formatRupiah(total);
        btnCheckout.disabled = false;
    }

    // Process Checkout
    function processCheckout() {
        if (cart.length === 0) return;

        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        // Prepare payload
        const payload = {
            total_harga: total,
            items: cart.map(item => ({
                id_barang: item.id,
                jumlah: item.qty,
                subtotal: item.price * item.qty
            }))
        };

        // Show loading
        const btnCheckout = document.getElementById('btnCheckout');
        const originalText = btnCheckout.innerText;
        btnCheckout.disabled = true;
        btnCheckout.innerText = 'Memproses...';

        fetch('{{ route("transaksi.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Transaksi Berhasil',
                    text: 'ID Transaksi: ' + data.id_transaksi,
                    didClose: () => {
                         window.location.reload(); // Reload to update stock
                    }
                });
                cart = [];
                renderCart();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan sistem'
            });
        })
        .finally(() => {
            btnCheckout.disabled = false;
            btnCheckout.innerText = originalText;
        });
    }
</script>
@endsection
