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
}
