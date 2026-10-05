<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Katalog untuk customer (bisa diakses siapa aja, gak perlu login)
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('catalog.show');

// Pemesanan (wajib login, tapi gak harus admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/pesan/{product}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/pesan/{product}', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/pesanan-saya', [OrderController::class, 'index'])->name('orders.index');
});

// Khusus admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/admin/pesanan', [OrderController::class, 'adminIndex'])->name('orders.adminIndex');
    Route::patch('/admin/pesanan/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});