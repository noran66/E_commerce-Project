<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index(Product $product)
    {
        $quantity = 1;

        return view('checkout', compact('product', 'quantity'));
    }
}
