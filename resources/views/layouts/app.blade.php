<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Ku | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #e8e9ed;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }
        .sidebar {
            width: 260px;
            background-color: #34495e;
            min-height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: -260px;
            z-index: 1000;
            transition: left 0.3s ease;
        }
        .sidebar.open {
            left: 0;
        }
        .sidebar-menu {
            padding: 60px 0 20px 0;
            flex-grow: 1;
        }
        .menu-item {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.95rem;
            border-left: 3px solid transparent;
        }
        .menu-item:hover {
            color: white;
            background-color: rgba(255,255,255,0.05);
        }
        .menu-item.active {
            color: white;
            background-color: rgba(255,255,255,0.08);
            border-left-color: white;
        }
        .menu-item i {
            font-size: 1.1rem;
        }
        .sidebar-footer {
            padding: 20px;
            background-color: rgba(0,0,0,0.15);
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-info {
            flex: 1;
        }
        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
        }
        .user-role {
            font-size: 0.8rem;
            color: #bdc3c7;
        }
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .top-header {
            height: 60px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 998;
            transition: left 0.3s ease;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #374151;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        .toggle-btn:hover {
            color: #0ea5e9;
        }
        .header-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem;
        }
        .header-title i {
            color: #0ea5e9;
            font-size: 1.3rem;
        }
        .header-title .brand {
            font-weight: 600;
            color: #000;
        }
        .header-title .page {
            font-weight: 400;
            color: #666;
        }
        .header-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header-user .user-avatar {
            width: 36px;
            height: 36px;
        }
        .header-user .user-info {
            text-align: right;
        }
        .header-user .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1f2937;
        }
        .header-user .user-role {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .main-content {
            margin-top: 60px;
            padding: 30px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s ease;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="{{ route('transaksi') }}" class="menu-item {{ request()->routeIs('transaksi') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Transaksi
            </a>
            <a href="{{ route('history') }}" class="menu-item {{ request()->routeIs('history') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Riwayat Transaksi
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
        <div class="sidebar-footer">
            <div class="user-profile">
                <img src="https://ui-avatars.com/api/?name=Siti+Mpruy&background=0ea5e9&color=fff" alt="User" class="user-avatar">
                <div class="user-info">
                    <div class="user-name">Siti Mpruy</div>
                    <div class="user-role">Kasir</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Header -->
    <div class="top-header" id="topHeader">
        <div class="header-left">
            <button class="toggle-btn" id="toggleBtn">
                <i class="bi bi-list"></i>
            </button>
            <div class="header-title">
                <i class="bi bi-shop"></i>
                <span class="brand">Kasir Ku</span>
                <span class="page">| @yield('page-title')</span>
            </div>
        </div>
        <div class="header-user">
            <img src="https://ui-avatars.com/api/?name=Siti+Mpruy&background=0ea5e9&color=fff" alt="User" class="user-avatar">
            <div class="user-info">
                <div class="user-name">Siti Mpruy</div>
                <div class="user-role">Kasir</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('toggleBtn');

        // Toggle sidebar
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('show');
        });

        // Close sidebar when clicking overlay
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('show');
        });

        // Sidebar starts closed on page load (default state)
    </script>

    @yield('scripts')
</body>
</html>

