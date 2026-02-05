<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Ku | Riwayat Transaksi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Instrument Sans', sans-serif;
            overflow-x: hidden;
        }
        .sidebar {
            width: 260px;
            background-color: #2c3e50; /* Dark Blue */
            min-height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-menu {
            padding: 20px 0;
            flex-grow: 1;
        }
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.95rem;
        }
        .menu-item:hover {
            color: white;
            background-color: rgba(255,255,255,0.05);
        }
        .menu-item.active {
            color: white;
            background-color: rgba(255,255,255,0.05);
            border-left: 3px solid white; 
        }
        .sidebar-footer {
            padding: 20px;
            background-color: rgba(0,0,0,0.1);
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
            display: flex;
            gap: 20px;
            min-height: 100vh;
        }
        .transaction-section {
            flex: 2;
        }
        .detail-section {
            flex: 1;
            min-width: 350px;
        }
        .filter-bar {
            background: white;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .transaction-card {
            background: white;
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .table thead th {
            background-color: white;
            border-bottom: 2px solid #f3f4f6;
            color: #1f2937;
            font-weight: 600;
            padding: 15px;
        }
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .detail-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .detail-header {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f3f4f6;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        .detail-label {
            color: #6b7280;
        }
        .detail-value {
            color: #1f2937; /* Dark gray for text */
            text-align: right;
            font-weight: 500;
        }
        .detail-value-gray {
             color: #9ca3af; /* Light gray for dates etc */
        }

        .item-list {
            margin-top: 20px;
            max-height: 400px;
            overflow-y: auto;
        }
        .item-card {
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .item-name {
            font-weight: 500;
            color: #4b5563;
        }
        .item-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: #6b7280;
            margin-top: 4px;
        }
        .pagination-container {
            padding: 15px;
            border-top: 1px solid #f3f4f6;
        }
        /* Custom scrollbar for sidebar if needed */
        .page-link {
            color: #6b7280;
            border: 1px solid #e5e7eb;
            margin: 0 2px;
            border-radius: 4px;
        }
        .page-item.active .page-link {
            background-color: #e5e7eb;
            border-color: #e5e7eb;
            color: #374151;
        }
        .logo-top-left {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 1.2rem;
            color: #374151;
            margin-bottom: 20px;
            /* Header outside sidebar in design? No, looks like sidebar is separate. */
        }
        /* Top header implementation */
        .top-header {
             height: 60px;
             background: white;
             display: flex;
             align-items: center;
             padding: 0 20px;
             margin-left: 260px; /* same as sidebar width */
             border-bottom: 1px solid #eee;
        }
        .top-header-title {
            font-size: 1.25rem;
            color: #333;
        }
        .top-header-subtitle {
           color: #888;
           font-weight: 300;
           margin-left: 5px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Dashboard Menu -->
        <div class="sidebar-menu mt-5">
             <!-- Spacer for consistency if needed, checking image -->
            <a href="#" class="menu-item">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-receipt"></i> Transaksi
            </a>
            <a href="#" class="menu-item active">
                <i class="bi bi-clock-history"></i> Riwayat Transaksi
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-exclamation-circle-fill"></i> Logout
            </a>
        </div>
        <div class="sidebar-footer">
            <div class="user-profile">
                <!-- Placeholder Image -->
                <img src="https://ui-avatars.com/api/?name=Siti+Mpruy&background=random" alt="User" class="user-avatar">
                <div>
                    <div style="font-weight: bold; font-size: 0.9rem;">Siti Mpruy</div>
                    <div style="font-size: 0.8rem; opacity: 0.7;">Kasir</div>
                </div>
            </div>
        </div>
    </div>

     <!-- Top Header (Simulated based on image 'Kasir Ku | Riwayat Transaksi' at top left, but sidebar is distinct) -->
     <!-- Actually the image shows "Kasir Ku | Riwayat Transaksi" top LEFT. 
          But the sidebar is dark blue. 
          Wait, looking closely at 'media__1770291762985.jpg', the sidebar goes ALL THE WAY UP? 
          No, the sidebar seems to be below a header? Or the header is part of the white area?
          Actually, the sidebar is on the left, dark blue.
          The top white bar has "Kasir Ku | Riwayat Transaksi" and user profile on right.
          BUT, the sidebar aligns with the left edge.
          Let's assume standard admin dashboard: Sidebar left (full height), Header top (next to sidebar).
     -->
     
     <div class="top-header">
        <div class="d-flex align-items-center">
            <i class="bi bi-shop me-2 text-info"></i>
            <span class="fw-bold">Kasir Ku</span>
            <span class="ms-1 fw-light text-secondary">| Riwayat Transaksi</span>
        </div>
        <div class="ms-auto d-flex align-items-center gap-2">
             <img src="https://ui-avatars.com/api/?name=Siti+Mpruy&background=random" alt="User" class="user-avatar" style="width: 32px; height:32px;">
             <div class="text-end">
                <div style="font-size: 0.85rem; font-weight: bold;">Siti Mpruy</div>
                <div style="font-size: 0.75rem; color: #888;">Kasir</div>
             </div>
        </div>
     </div>


    <div class="main-content ps-4 pt-4"> <!-- Override margin-left handling by having main-content container wrap everything right of sidebar -->
        <!-- But I defined main-content with margin-left 260px. 
             If top-header is also 260px left, then main-content should just start below it?
             OR top-header is full width and sidebar is below?
             The image shows sidebar is FULL HEIGHT. The header text is in the white area to the RIGHT of the sidebar.
             Wait, Image 1 (media...985.jpg): "Kasir Ku | Riwayat Transaksi" is in the white area Top Left (next to sidebar).
             The sidebar has "Dashboard", "Transaksi"...
             So: Sidebar (Left, Dark). Content Area (Right, White/Gray).
             Top of Content Area: Header Text.
             Below Header: Button/Filter, Table, etc.
        -->
        
        <div style="width: 100%;">
            <!-- Filter Bar -->
            <div class="filter-bar">
                <span class="fw-bold text-secondary">Filter:</span>
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" value="01/02/2025 - 02/03/2026">
                    <span class="input-group-text bg-white"><i class="bi bi-clock"></i></span>
                </div>
                <button class="btn btn-primary px-4">Filter</button>
            </div>

            <div class="d-flex gap-4">
                <!-- Table Section -->
                <div class="transaction-section">
                    <div class="transaction-card">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th>No.Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Repeat 18 times as per pagination or similar -->
                                @for ($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="fw-bold">#INV-02-01/02/2025</td>
                                    <td>01-02-2025</td>
                                    <td>94.000.00</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                        <div class="pagination-container d-flex justify-content-between align-items-center">
                            <button class="btn btn-outline-secondary btn-sm">Previous</button>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-outline-secondary">1</button>
                                <button class="btn btn-sm btn-outline-secondary">2</button>
                                <button class="btn btn-sm btn-outline-secondary">3</button>
                                <span>...</span>
                                <button class="btn btn-sm btn-outline-secondary">18</button>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary">next</button>
                        </div>
                    </div>
                </div>

                <!-- Detail Section -->
                <div class="detail-section">
                    <div class="detail-card">
                        <h5 class="detail-header">Detail Penjualan</h5>
                        
                        <div class="detail-row">
                            <span class="detail-label">Nama Pelanggan</span>
                            <span class="detail-value-gray">Anas Jayadi Saputra</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">No.Invoice</span>
                            <span class="detail-value-gray">#INV-02-01/02/2025</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Tanggal</span>
                            <span class="detail-value-gray">2025-02-01</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Total Belanja</span>
                            <span class="detail-value-gray">94.000.00</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Petugas Kasir</span>
                            <span class="detail-value-gray">Siti Mpruy</span>
                        </div>

                        <div class="item-list mt-4">
                            @for ($j = 0; $j < 8; $j++)
                            <div class="item-card">
                                <div class="item-name">Indomie Goreng Rebus</div>
                                <div class="item-meta">
                                    <div class="text-dark fw-bold">Rp. 3.500</div>
                                    <div class="text-dark fw-bold">qty: 28x &nbsp; Rp 54.000</div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
