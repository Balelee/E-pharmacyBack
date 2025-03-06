<?php

use App\Http\Controllers\PayementController;
use Illuminate\Support\Facades\Route;

Route::get('/paiements', [PayementController::class, 'getPayements']);
