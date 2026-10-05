<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class EstimatorController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('estimator.index', compact('brands'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'processor' => 'required',
            'ram' => 'required|numeric',
            'storage_type' => 'required',
            'condition' => 'required',
        ]);

        // Base price calculation logic
        $basePrice = 2000000; // Standar dasar

        // Taksiran Processor
        if (str_contains(strtolower($request->processor), 'i7') || str_contains(strtolower($request->processor), 'ryzen 7')) {
            $basePrice += 2500000;
        } elseif (str_contains(strtolower($request->processor), 'i5') || str_contains(strtolower($request->processor), 'ryzen 5')) {
            $basePrice += 1500000;
        } else {
            $basePrice += 800000;
        }

        // Taksiran RAM
        $basePrice += ($request->ram / 4) * 300000;

        // Taksiran Storage
        if ($request->storage_type == 'ssd') {
            $basePrice += 400000;
        }

        // Potongan Kondisi
        $multiplier = 1.0;
        if ($request->condition == 'mulus') {
            $multiplier = 1.0;
        } elseif ($request->condition == 'sedang') {
            $multiplier = 0.85;
        } elseif ($request->condition == 'minus_ringan') {
            $multiplier = 0.70;
        } else {
            $multiplier = 0.50;
        }

        // Potongan Kelengkapan
        if ($request->completeness == 'batangan') {
            $basePrice -= 200000;
        }

        $estimatedPrice = max(500000, $basePrice * $multiplier);

        return response()->json([
            'min_price' => number_format($estimatedPrice * 0.9, 0, ',', '.'),
            'max_price' => number_format($estimatedPrice * 1.1, 0, ',', '.'),
            'raw_min' => $estimatedPrice * 0.9,
        ]);
    }
}