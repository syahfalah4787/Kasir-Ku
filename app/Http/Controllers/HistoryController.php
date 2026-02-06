<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['user', 'detailTransaksi.barang'])
            ->latest();

        if ($request->has('start_date') && $request->has('end_date') && 
            !empty($request->start_date) && !empty($request->end_date)) {
            $query->whereBetween('tanggal_transaksi', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        $transaksi = $query->paginate(10);
            
        return view('dashboard.history', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'detailTransaksi.barang'])->findOrFail($id);
        return view('dashboard.history-detail', compact('transaksi'));
    }
}
