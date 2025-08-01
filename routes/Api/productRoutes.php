<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'getProducts']);
    Route::post('/', [ProductController::class, 'storeProduct']);
    Route::get('/search-product', [ProductController::class, 'searchProduct']);
    // --------------------- ROUTES PROTEGER --------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/{product}', [ProductController::class, 'updateProduct']);
        Route::get('/{product}', [ProductController::class, 'findProduct']);
        Route::delete('/{product}', [ProductController::class, 'deleteProduct']);
    });
});
