@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('styles')
<style>
    .page-heading {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 25px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 18px;
        opacity: 0;
        animation: slideUp 0.5s ease forwards;
    }
    .stat-card:nth-child(1) {
        animation-delay: 0.1s;
    }
    .stat-card:nth-child(2) {
        animation-delay: 0.2s;
    }
    .stat-card:nth-child(3) {
        animation-delay: 0.3s;
    }
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
    }
    .stat-icon.blue {
        background-color: #3b82f6;
    }
    .stat-icon.green {
        background-color: #10b981;
    }
    .stat-icon.orange {
        background-color: #f59e0b;
    }
    .stat-content {
        flex: 1;
    }
    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 6px;
    }
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
    }
    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .chart-container {
        position: relative;
        height: 400px;
    }
</style>
@endsection

@section('content')
    <h1 class="page-heading">Data Penjualan</h1>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-box-seam"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Barang</div>
                <div class="stat-value" data-target="{{ $totalBarang }}">0</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Transaksi</div>
                <div class="stat-value" data-target="{{ $totalTransaksi }}">0</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="bi bi-wallet2"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Pendapatan</div>
                <div class="stat-value" data-target="{{ $totalPendapatan }}">0</div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="chart-card">
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Counter Animation Function
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16); // 60fps
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format number with proper separators
            const formatted = formatNumber(current, target);
            element.textContent = formatted;
        }, 16);
    }
    
    function formatNumber(value, target) {
        // Check if target has decimal
        const hasDecimal = target.toString().includes('.');
        
        if (hasDecimal) {
            // For decimal numbers (like 223.2322)
            return value.toFixed(4).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        } else {
            // For whole numbers
            const rounded = Math.floor(value);
            return rounded.toLocaleString('id-ID').replace(/,/g, '.');
        }
    }
    
    // Start counter animations when page loads
    window.addEventListener('load', () => {
        const statValues = document.querySelectorAll('.stat-value[data-target]');
        
        statValues.forEach((element, index) => {
            const target = parseFloat(element.dataset.target);
            
            // Delay each counter slightly for staggered effect
            setTimeout(() => {
                animateCounter(element, target, 2000);
            }, index * 100 + 300); // Start after card animation
        });
    });
    
    // Chart.js
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($data) !!},
                fill: true,
                backgroundColor: function(context) {
                    const chart = context.chart;
                    const {ctx, chartArea} = chart;
                    if (!chartArea) {
                        return null;
                    }
                    const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                    gradient.addColorStop(0, 'rgba(147, 197, 253, 0.1)');
                    gradient.addColorStop(1, 'rgba(147, 197, 253, 0.6)');
                    return gradient;
                },
                borderColor: '#3b82f6',
                borderWidth: 2,
                tension: 0.4,
                pointRadius: 3,
                pointHoverRadius: 6,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#3b82f6',
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#9ca3af',
                        font: {
                            size: 11
                        },
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: '#f3f4f6',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#9ca3af',
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });
</script>
@endsection

