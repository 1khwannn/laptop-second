<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopOfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Models\LaptopOffer;
use App\Models\laptop;
use App\Models\Brand;
use App\Models\Offer;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Route cetak nota buyback
    Route::get('/offers/{offer}/receipt', function (Offer $offer) {
        return view('offers.receipt', compact('offer'));
    })->name('offers.receipt');
});

Route::get('/', function () {
    $featuredLaptops = Laptop::with('brand')
        ->where('status', 'available')
        ->latest()
        ->take(6)
        ->get();

    $brands = Brand::withCount(['laptops' => function($q) {
        $q->where('status', 'available');
    }])->get();

    return view('welcome', compact('featuredLaptops', 'brands'));
})->name('home');

    Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');   

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