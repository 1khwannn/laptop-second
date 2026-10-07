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

        $basePrice = 2000000;

        if (str_contains(strtolower($request->processor), 'i7') || str_contains(strtolower($request->processor), 'ryzen 7')) {
            $basePrice += 2500000;
        } elseif (str_contains(strtolower($request->processor), 'i5') || str_contains(strtolower($request->processor), 'ryzen 5')) {
            $basePrice += 1500000;
        } else {
            $basePrice += 800000;
        }

        $basePrice += ($request->ram / 4) * 300000;

        if ($request->storage_type == 'ssd') {
            $basePrice += 400000;
        }

        $multiplier = match($request->condition) {
            'mulus' => 1.0,
            'sedang' => 0.85,
            'minus_ringan' => 0.70,
            default => 0.50,
        };

        if ($request->completeness == 'batangan') {
            $basePrice -= 200000;
        }

        $estimatedPrice = max(500000, $basePrice * $multiplier);

        return response()->json([
            'min_price' => number_format($estimatedPrice * 0.9, 0, ',', '.'),
            'max_price' => number_format($estimatedPrice * 1.1, 0, ',', '.'),
        ]);
    }
}