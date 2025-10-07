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
        $user = Auth::user(); // لازم يكون اليوزر مسجل دخول
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

      $cartItem = CartItem::where('user_id', $user->id)
    ->where('product_id', $productId)
    ->first();

if ($cartItem) {
    // لو موجود بالفعل، نزيد الكمية
    $cartItem->quantity += $quantity;
    $cartItem->save();
} else {
    // لو مش موجود، نضيفه جديد
    $cartItem = CartItem::create([
        'user_id' => $user->id,
        'product_id' => $productId,
        'quantity' => $quantity,
    ]);
}


        return redirect()->route('cart');
    }

    public function index()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        return view('cart', compact('cartItems'));
    }
}
