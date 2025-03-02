<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/orders', [OrderController::class, 'getOrders']);
Route::post('/orders', [OrderController::class, 'storeOrder']);
Route::get('/orders/{order}', [OrderController::class, 'findOrder']);
Route::delete('/orders/{order}', [OrderController::class, 'deleteOrder']);
