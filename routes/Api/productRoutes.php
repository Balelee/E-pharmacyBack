<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/products', [ProductController::class, 'storeProduct']);
Route::put('/products/{product}', [ProductController::class, 'updateProduct']);
Route::get('/products/{product}', [ProductController::class, 'findProduct']);
Route::delete('/products/{product}', [ProductController::class, 'deleteProduct']);
