<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('base');
});

Route::get('/products', function () {
    return view('layouts/products');
});
