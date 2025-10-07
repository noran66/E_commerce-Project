<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
{
    $cart = session()->get('cart', []);
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    if(isset($cart[$productId])) {
        $cart[$productId] += $quantity;
    } else {
        $cart[$productId] = $quantity;
    }

    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Product added to cart!');
}

   public function index()
{
    // إذا كنت تستخدم session
    $cart = session()->get('cart', []);
    $cartItems = [];

    foreach ($cart as $productId => $quantity) {
        $product = \App\Models\Product::find($productId);
        if ($product) {
            $cartItems[] = (object)[
                'product' => $product,
                'quantity' => $quantity,
            ];
        }
    }

    return view('cart', compact('cartItems'));
}
public function remove($id)
{
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);
    return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
}
public function update(Request $request)
{
    $cart = session()->get('cart', []);

    if ($request->has('products')) {
        foreach ($request->products as $id => $data) {
            if (isset($cart[$id])) {
                $cart[$id] = $data['quantity'];
            }
        }
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
}
}
