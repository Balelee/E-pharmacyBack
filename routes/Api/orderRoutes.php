<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'getOrders']);
Route::post('/orders', [OrderController::class, 'storeOrder']);
Route::get('/orders/{order}', [OrderController::class, 'findOrder']);
Route::delete('/orders/{order}', [OrderController::class, 'deleteOrder']);
Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);
