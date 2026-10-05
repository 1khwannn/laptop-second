<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopOfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\EstimatorController;
use App\Models\LaptopOffer;
use Illuminate\Support\Facades\Route;

// Beranda (Public)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Kalkulator Estimasi (Public)
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

// Route yang Membutuhkan Login & Verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard User (Menampilkan Riwayat Penawaran)
    Route::get('/dashboard', function () {
        $offers = LaptopOffer::with('brand')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('offers'));
    })->name('dashboard');

    // Form Jual Laptop
    Route::get('/jual-laptop', [LaptopOfferController::class, 'create'])->name('offers.create');
    Route::post('/jual-laptop', [LaptopOfferController::class, 'store'])->name('offers.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';