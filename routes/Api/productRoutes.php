<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('products')->group(function (){
// --------------------- ROUTES PROTEGER --------------------
Route::middleware('auth:sanctum')->group(function () {
Route::get('/', [ProductController::class, 'getProducts']);
Route::post('/', [ProductController::class, 'storeProduct']);
Route::put('/{product}', [ProductController::class, 'updateProduct']);
Route::get('/{product}', [ProductController::class, 'findProduct']);
Route::delete('/{product}', [ProductController::class, 'deleteProduct']);
});
});
