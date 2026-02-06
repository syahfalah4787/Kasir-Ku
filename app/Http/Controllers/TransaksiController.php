<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('dashboard.transaksi', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_harga' => 'required|numeric',
            'items' => 'required|array',
            'items.*.id_barang' => 'required|exists:barang,id_barang',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.subtotal' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            // 1. Create Transaction
            $transaksi = Transaksi::create([
                'tanggal_transaksi' => now(),
                'total_harga' => $request->total_harga,
                'id_user' => Auth::id(),
            ]);

            // 2. Create Details and Update Stock
            foreach ($request->items as $item) {
                // Check stock
                $barang = Barang::findOrFail($item['id_barang']);
                if ($barang->stok < $item['jumlah']) {
                    throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi.");
                }

                // Deduct stock
                $barang->decrement('stok', $item['jumlah']);

                // Create Detail
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang' => $item['id_barang'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil disimpan',
                'id_transaksi' => $transaksi->id_transaksi
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
