<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;
use App\Http\Controllers\PilremberController;

    // --------------------- ROUTES PROTEGER --------------------
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tips', [TipController::class, 'getTips']); // Route pour les conseils d annonce du systeme 
    Route::get('/pilrembers', [PilremberController::class, 'getRemenbers']);
    Route::post('/pilrembers', [PilremberController::class, 'storeRemenber']);
    Route::delete('/pilrembers/{pilrember}', [PilremberController::class, 'deleteRemenber']);

    });


