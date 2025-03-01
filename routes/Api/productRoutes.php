<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/products', [ProductController::class, 'storeProduct']);
Route::put('/products/{product}', [ProductController::class, 'updateProduct']);
Route::get('/products/{product}', [ProductController::class, 'findProduct']);
Route::delete('/products/{product}', [ProductController::class, 'deleteProduct']);
