<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('credentials/login');
});

Route::get('/register', function () {
    return view('credentials/register');
});

Route::get('/products', function () {
    return view('layouts/products');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login');
    Route::get('/action-register', 'register');
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/all-products', 'get_all');
    Route::get('/product/{id?}', 'get');
    Route::post('/product', 'create');
    Route::put('/product', 'update');
    Route::delete('/product/{id}', 'delete');
});
