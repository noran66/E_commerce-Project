<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index(Product $product)
    {
        // هنا ممكن نضيف كمية المنتج لو عايزة
        $quantity = 1;

        return view('checkout', compact('product', 'quantity'));
    }
}
