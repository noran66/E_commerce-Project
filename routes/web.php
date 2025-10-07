<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


// الصفحة الرئيسية
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
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



Route::get('/auth', [AuthController::class, 'showForm'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/user-dashboard', function () {
    $user = Auth::user();
    return view('user-dashboard', compact('user'));
})->name('user-dashboard')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
