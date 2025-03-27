<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\OrderDetailController;

Route::get('/pharFliter', [PharmacyController::class, 'getPharFliter']);
