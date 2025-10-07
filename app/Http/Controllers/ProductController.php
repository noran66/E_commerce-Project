<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['colors', 'reviews.user'])->findOrFail($id);
        $similarProducts = Product::where('id', '!=', $id)->take(4)->get();
        return view('product', compact('product', 'similarProducts'));
    }
}
