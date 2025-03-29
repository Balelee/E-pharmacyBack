<?php

use App\Http\Controllers\PharmacyController;
use Illuminate\Support\Facades\Route;

Route::get('/filterProduct', [PharmacyController::class, 'getPharFliter']);
