<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopOfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\EstimatorController;
use App\Http\Controllers\TradeInController;
use App\Http\Controllers\LaptopsController;
use App\Models\LaptopOffer;
use Illuminate\Support\Facades\Route;

// Halaman Utama / Beranda (Public)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Kalkulator Estimasi Harga (Public)
Route::get('/kalkulator-estimasi', [EstimatorController::class, 'index'])->name('estimator.index');
Route::post('/kalkulator-estimasi/hitung', [EstimatorController::class, 'calculate'])->name('estimator.calculate');

// Katalog & Detail Laptop (Public)
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');   

// Route yang Membutuhkan Login (Auth)
Route::middleware(['auth'])->group(function () {
    // Cetak nota buyback
    Route::get('/offers/{offer}/receipt', function (App\Models\Offer $offer) {
        return view('offers.receipt', compact('offer'));
    })->name('offers.receipt');
});

// Route Admin (Membutuhkan Login & Role Admin)
Route::middleware(['auth', 'admin'])->group(function () {
    // Kelola Penawaran Masuk & Trade-In
    Route::get('/admin/offers', [LaptopOfferController::class, 'adminIndex'])->name('admin.offers.index');
    Route::patch('/admin/offers/{offer}/status', [LaptopOfferController::class, 'updateStatus'])->name('admin.offers.updateStatus');
});

// Route yang Membutuhkan Login & Verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard User (Menampilkan Riwayat Penawaran)
    Route::get('/dashboard', function () {
        $myOffers = LaptopOffer::with('brand')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('myOffers'));
    })->name('dashboard');

    // Form Jual Laptop
    Route::get('/jual-laptop', [LaptopOfferController::class, 'create'])->name('offers.create');
    Route::post('/jual-laptop', [LaptopOfferController::class, 'store'])->name('offers.store');

    // Tukar Tambah (Trade-In)
    Route::get('/tukar-tambah', [TradeInController::class, 'index'])->name('trade-in.index');
    Route::post('/tukar-tambah', [TradeInController::class, 'store'])->name('trade-in.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';