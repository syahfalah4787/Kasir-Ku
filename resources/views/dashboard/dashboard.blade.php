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
                <i class="bi bi-archive"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total produk terjual</div>
                <div class="stat-value">122.023,00</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total transaksi</div>
                <div class="stat-value">223.2322</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="bi bi-wallet2"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total pemasukan</div>
                <div class="stat-value">120.000.000</div>
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
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Figma', 'Swatch', 'XD', 'PS', 'AI', 'CorelDRAW', 'InDesign', 'Canva', 'Webflow', 'Affinity', 'Marker', 'Figma'],
            datasets: [{
                label: '2020',
                data: [180, 220, 240, 280, 320, 300, 350, 280, 320, 360, 380, 400],
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
                borderColor: '#93c5fd',
                borderWidth: 2,
                tension: 0.4,
                pointRadius: 0,
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
                    max: 400,
                    ticks: {
                        stepSize: 80,
                        color: '#9ca3af',
                        font: {
                            size: 11
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
