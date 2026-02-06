<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users (Admin & Kasir) - Plain Text Password as requested
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => 'password', // Plain text
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Siti Kasir',
            'username' => 'kasir',
            'password' => 'password', // Plain text
            'role' => 'kasir',
        ]);

        // 2. Create Categories
        $katMakanan = Kategori::create(['nama_kategori' => 'Makanan']);
        $katMinuman = Kategori::create(['nama_kategori' => 'Minuman']);
        $katSnack = Kategori::create(['nama_kategori' => 'Snack']);

        // 3. Create Products
        // Makanan
        Barang::create([
            'nama_barang' => 'Indomie Goreng',
            'harga' => 3500,
            'stok' => 100,
            'id_kategori' => $katMakanan->id_kategori,
        ]);

        Barang::create([
            'nama_barang' => 'Nasi Goreng Spesial',
            'harga' => 15000,
            'stok' => 50,
            'id_kategori' => $katMakanan->id_kategori,
        ]);

        // Minuman
        Barang::create([
            'nama_barang' => 'Teh Botol Sosro',
            'harga' => 5000,
            'stok' => 80,
            'id_kategori' => $katMinuman->id_kategori,
        ]);

        Barang::create([
            'nama_barang' => 'Aqua 600ml',
            'harga' => 4000,
            'stok' => 120,
            'id_kategori' => $katMinuman->id_kategori,
        ]);

        Barang::create([
            'nama_barang' => 'Kopi Kapal Api',
            'harga' => 3000,
            'stok' => 200,
            'id_kategori' => $katMinuman->id_kategori,
        ]);

        // Snack
        Barang::create([
            'nama_barang' => 'Chitato Sapi Panggang',
            'harga' => 12000,
            'stok' => 40,
            'id_kategori' => $katSnack->id_kategori,
        ]);

        Barang::create([
            'nama_barang' => 'Oreo Original',
            'harga' => 8000,
            'stok' => 60,
            'id_kategori' => $katSnack->id_kategori,
        ]);
    }
}
