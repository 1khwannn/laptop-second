<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\LaptopOffer;
use Illuminate\Http\Request;

class LaptopOfferController extends Controller
{
    // Tampilkan Form Pengajuan Jual Laptop
    public function create(Request $request)
    {
        $brands = Brand::orderBy('name')->get();
        $selectedBrand = $request->query('brand');

        return view('offers.create', compact('brands', 'selectedBrand'));
    }

    // Simpan Data Penawaran dari User
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_name' => 'required|string|max:255',
            'processor' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'condition_description' => 'required|string',
            'expected_price' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        LaptopOffer::create($validated);

        return redirect()->route('dashboard')->with('success', 'Penawaran laptop Anda berhasil dikirim! Tim kami akan segera meninjaunya.');
    }
}