<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPharmacyController;

    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', [OrderController::class, 'getOrdersbyUser']);
    Route::get('/orders-pharmacien', [OrderPharmacyController::class, 'getPharmacienOrders']);
    Route::post('/orders', [OrderController::class, 'storeOrder']);
    Route::get('/orders/{order}', [OrderController::class, 'findOrder']);
    Route::delete('/orders/{order}', [OrderController::class, 'deleteOrder']);

     Route::post('/orders/{orderId}/pharmacies/response', [OrderPharmacyController::class, 'storeResponse']);
    });



