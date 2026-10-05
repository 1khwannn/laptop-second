<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
       $products = Product::with('category')->where('stock', '>', 0)->latest()->get(); return view('catalog.index', compact('products')); } public function show(string $id) { $product = Product::with('category')->findOrFail($id); return view('catalog.show', compact('product')); 
       }
    }


