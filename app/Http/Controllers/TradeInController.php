<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Brand;
use App\Models\LaptopOffer;
use Illuminate\Http\Request;

class TradeInController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $availableLaptops = Laptop::where('status', 'available')->get();
        return view('trade-in.index', compact('brands', 'availableLaptops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'target_laptop_id' => 'required|exists:laptops,id',
            'brand_id' => 'required',
            'model_name' => 'required',
            'estimated_price' => 'required|numeric',
            'phone_number' => 'required',
        ]);

        $targetLaptop = Laptop::findOrFail($request->target_laptop_id);
        $topUpAmount = $targetLaptop->price - $request->estimated_price;

        LaptopOffer::create([
            'user_id' => auth()->id(),
            'brand_id' => $request->brand_id,
            'model_name' => "[TRADE-IN] Target: {$targetLaptop->title} | " . $request->model_name,
            'processor' => $request->processor ?? 'Standar',
            'ram' => $request->ram ?? '8 GB',
            'storage' => $request->storage ?? 'SSD',
            'expected_price' => $request->estimated_price,
            'phone_number' => $request->phone_number,
            'condition_description' => "Pengajuan Trade-In. Estimasi Tambah Uang: Rp " . number_format(max(0, $topUpAmount), 0, ',', '.'),
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan Tukar Tambah berhasil dikirim!');
    }
}