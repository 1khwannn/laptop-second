<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\LaptopOffer;
use Illuminate\Http\Request;

class LaptopOfferController extends Controller
{
    // Menampilkan daftar penawaran masuk untuk Admin
    public function adminIndex()
    {
        $offers = LaptopOffer::with(['user', 'brand'])->latest()->get();
        return view('admin.offers.index', compact('offers'));
    }

    // Mengubah status penawaran
    public function updateStatus(Request $request, LaptopOffer $offer)
    {
        $request->validate([
            'status' => 'required|in:pending,negotiating,accepted,rejected,completed'
        ]);

        $offer->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status penawaran berhasil diperbarui!');
    }

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