<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPharmacyController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/requests/stats', [OrderController::class, 'stats']);

    Route::get('/requests', [OrderController::class, 'getOrdersbyUser']);
    Route::get('/requests-w-pharmacien', [OrderPharmacyController::class, 'getPharmacienWOrders']);
    Route::get('/requests-tr-pharmacien', [OrderPharmacyController::class, 'getPharmacienTOrROrders']);
    Route::post('/requests', [OrderController::class, 'storeOrder']);
    Route::get('/requests/{order}/cancel', [OrderController::class, 'cancelOrder']);
    Route::get('/requests/{order}', [OrderController::class, 'findOrder']);
    Route::delete('/requests/{order}', [OrderController::class, 'deleteOrder']);
    
    Route::post('/requests/{orderId}/pharmacies/response', [OrderPharmacyController::class, 'storeResponse']);
    Route::get('/responses/{order}', [OrderController::class, 'getClientRequestResponses']);
});
