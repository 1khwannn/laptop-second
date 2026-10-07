<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Brand;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    // Menampilkan Katalog & Filter di Halaman Utama (B2C)
    public function index(Request $request)
    {
        $query = Laptop::with('brand')->where('status', 'available');

        // Filter Berdasarkan Brand
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Filter Berdasarkan Grade Kondisi
        if ($request->filled('grade')) {
            $query->where('condition_grade', 'like', '%' . $request->grade . '%');
        }

        // Pencarian Berdasarkan Kata Kunci
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $laptops = $query->latest()->paginate(9);
        $brands = Brand::all();

        return view('laptops.index', compact('laptops', 'brands'));
    }

    // Halaman Detail Laptop & Sertifikat Inspeksi QC 15 Poin
    public function show($slug)
    {
        $laptop = Laptop::with('brand')->where('slug', $slug)->firstOrFail();
        return view('laptops.show', compact('laptop'));
    }
}