<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->get();

        return view('shop.index', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cart' => 'required|array',
            'total' => 'required|numeric'
        ]);

        $order = \App\Models\Order::create([
            'total_amount' => $data['total'],
            'items' => $data['cart'],
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        return response()->json(['order_id' => $order->id]);
    }
}
