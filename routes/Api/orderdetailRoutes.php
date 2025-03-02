<?php

use App\Http\Controllers\OrderDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/order_details/{order_detail}', [OrderDetailController::class, 'findOrderDetail']);
