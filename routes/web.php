<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SubscriberController;

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/blog', function () {
    return view('blog'); 
});
Route::get('/service', function () {
    return view('service'); 
});

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('/checkout/{product}', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/cart', function () {
    return view('cart'); 
});


Route::post('/add-to-cart', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');


Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe.store');