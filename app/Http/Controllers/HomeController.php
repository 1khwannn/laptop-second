<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Laptop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::orderBy('name')->get();

        $query = Laptop::with('brand')->where('status', 'available');

        // Filter berdasarkan Merek
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Filter berdasarkan Kata Kunci
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('processor', 'like', "%{$search}%")
                  ->orWhere('ram', 'like', "%{$search}%")
                  ->orWhere('storage', 'like', "%{$search}%");
            });
        }

        $laptops = $query->latest()->paginate(9)->withQueryString();

        return view('welcome', compact('laptops', 'brands'));
    }
}