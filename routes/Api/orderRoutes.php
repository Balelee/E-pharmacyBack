<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', [OrderController::class, 'getOrdersbyUser']);
    Route::get('/orders-pharmacien', [OrderController::class, 'getAvailableOrders']);
    Route::post('/orders', [OrderController::class, 'storeOrder']);
    Route::get('/orders/{order}', [OrderController::class, 'findOrder']);
    Route::delete('/orders/{order}', [OrderController::class, 'deleteOrder']);
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);
    Route::get('/orders-valide', [OrderController::class, 'getOrderValide']);
    Route::get('/orders-annule', [OrderController::class, 'getOrderAnnule']);
    });



