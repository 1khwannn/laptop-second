<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Laptop;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Laptop::with('brand')->where('status', 'available');

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand_id', $request->brand);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $laptops = $query->latest()->paginate(9);
        $brands = Brand::orderBy('name')->get();

        return view('catalog.index', compact('laptops', 'brands'));
    }

    public function show($slug)
    {
        $laptop = Laptop::with('brand')->where('slug', $slug)->firstOrFail();
        
        // Nomor WA Toko (Ganti dengan nomor WhatsApp Admin Anda)
        $waNumber = '6281234567890';
        $waText = urlencode("Halo Admin LaptopSecond, saya berminat membeli unit laptop bekas:\n\n*{$laptop->title}*\nHarga: Rp " . number_format($laptop->price, 0, ',', '.') . "\n\nApakah unit ini masih tersedia?");
        $waUrl = "https://wa.me/{$waNumber}?text={$waText}";

        return view('catalog.show', compact('laptop', 'waUrl'));

        $laptop = Laptop::with('brand')->where('slug', $slug)->firstOrFail();
        return view('laptops.show', compact('laptop'));
    }
}