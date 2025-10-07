use App\Models\Product;

public function shop() {
    $products = Product::all();
    return view('shop', compact('products'));
}
