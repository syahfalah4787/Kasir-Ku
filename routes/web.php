<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi');
    Route::post('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');

    Route::get('/history', [\App\Http\Controllers\HistoryController::class, 'index'])->name('history');
    Route::get('/history/{id}', [\App\Http\Controllers\HistoryController::class, 'show'])->name('history.show');

    Route::middleware(['admin'])->group(function () {
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
        Route::resource('barang', \App\Http\Controllers\BarangController::class);
    });
});
