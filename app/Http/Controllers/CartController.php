<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            return $this->addToDatabaseCart($request);
        } else {
            return $this->addToSessionCart($request);
        }
    }

    private function addToDatabaseCart(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $existingCartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            $product = Product::find($productId);
            
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    private function addToSessionCart(Request $request)
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
        if (Auth::check()) {
            return $this->showDatabaseCart();
        } else {
            return $this->showSessionCart();
        }
    }

    private function showDatabaseCart()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        return view('cart', compact('cartItems'));
    }

    private function showSessionCart()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = (object)[
                    'id' => $productId, 
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        return view('cart', compact('cartItems'));
    }

    public function remove($id)
    {
        if (Auth::check()) {
            return $this->removeFromDatabaseCart($id);
        } else {
            return $this->removeFromSessionCart($id);
        }
    }

    private function removeFromDatabaseCart($id)
    {
        $user = Auth::user();
        
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    private function removeFromSessionCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            return $this->updateDatabaseCart($request);
        } else {
            return $this->updateSessionCart($request);
        }
    }

    private function updateDatabaseCart(Request $request)
    {
        $user = Auth::user();

        if ($request->has('products')) {
            foreach ($request->products as $id => $data) {
                $cartItem = CartItem::where('user_id', $user->id)
                    ->where('id', $id)
                    ->first();

                if ($cartItem && isset($data['quantity'])) {
                    if ($data['quantity'] > 0) {
                        $cartItem->quantity = $data['quantity'];
                        $cartItem->save();
                    } else {
                        $cartItem->delete();
                    }
                }
            }
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    private function updateSessionCart(Request $request)
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

    public function migrateSessionToDatabase()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionCart = session()->get('cart', []);

            foreach ($sessionCart as $productId => $quantity) {
                $existingCartItem = CartItem::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($existingCartItem) {
                    $existingCartItem->quantity += $quantity;
                    $existingCartItem->save();
                } else {
                    $product = Product::find($productId);
                    if ($product) {
                        CartItem::create([
                            'user_id' => $user->id,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'price' => $product->price
                        ]);
                    }
                }
            }

            session()->forget('cart');
            
            return true;
        }
        
        return false;
    }
}