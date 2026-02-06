<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = Kategori::count();
        $totalBarang = Barang::count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total_harga');
        // Chart Data (Daily Sales for Current Month)
        $chartData = Transaksi::selectRaw('DATE(tanggal_transaksi) as date, SUM(total_harga) as total')
            ->whereMonth('tanggal_transaksi', date('m'))
            ->whereYear('tanggal_transaksi', date('Y'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        // Fill in missing days
        $daysInMonth = date('t');
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT);
            $labels[] = date('d M', strtotime($date));
            
            $dayData = $chartData->firstWhere('date', $date);
            $data[] = $dayData ? $dayData->total : 0;
        }

        return view('dashboard.dashboard', compact(
            'totalKategori', 
            'totalBarang', 
            'totalTransaksi', 
            'totalPendapatan',
            //'transaksiTerbaru',
            'labels',
            'data'
        ));
    }
}
