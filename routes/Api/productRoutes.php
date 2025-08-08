<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('products')->group(function () {
    // --------------------- ROUTES PROTEGER --------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [ProductController::class, 'getProducts']);
        Route::get('/search-product', [ProductController::class, 'searchProduct']);
    });
});
