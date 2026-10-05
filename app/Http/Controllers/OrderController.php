<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('orders.create', compact('product'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'status' => 'pending',
            'shipping_address' => $validated['shipping_address'],
            'total_price' => $product->price,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.');
    }

    public function index()
    {
        $orders = Order::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
    public function adminIndex() { $orders = Order::with(['product', 'user'])->latest()->get(); return view('orders.admin-index', compact('orders')); } public function updateStatus(Request $request, $id) { $order = Order::findOrFail($id); $order->update(['status' => $request->status]); return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!'); }
}