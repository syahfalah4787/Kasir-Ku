<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/transaksi', function () {
    return view('dashboard.transaksi');
})->name('transaksi');

Route::get('/history', function () {
    return view('dashboard.history');
})->name('history');
