<?php

use Illuminate\Support\Facades\Route;

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
