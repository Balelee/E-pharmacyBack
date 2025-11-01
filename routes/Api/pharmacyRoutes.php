<?php

use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PharmacyGardeController;
use Illuminate\Support\Facades\Route;

Route::get('/pharmacies', [PharmacyController::class, 'getPharmacies']);
Route::post('/pharmacies', [PharmacyController::class, 'storePharmacy']);
Route::put('/pharmacies/{pharmacy}', [PharmacyController::class, 'updatePharmacy']);
Route::get('/pharmacies/{pharmacy}', [PharmacyController::class, 'findPharmacy']);
Route::delete('/pharmacies/{pharmacy}', [PharmacyController::class, 'deletePharmacy']);