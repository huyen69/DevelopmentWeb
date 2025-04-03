<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/api/products', [ProductController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
