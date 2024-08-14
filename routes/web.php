<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/login', function () {
    return view('credentials/login');
})->name('login');

Route::get('/register', function () {
    return view('credentials/register');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/action-login', 'login');
    Route::post('/action-register', 'register');
    Route::get('/logout', 'close_sesion');
});


Route::middleware(['auth'])->controller(ProductController::class)->group(function () {
    Route::get('/products', 'get_all');
    Route::get('/product/{id?}', 'get');
    Route::get('/see-product/{id}', 'get');
    Route::post('/create-product', 'create');
    Route::post('/update-product', 'update');
    Route::delete('/delete-product/{id}', 'delete');
});
