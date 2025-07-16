<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;
use App\Http\Controllers\PilremberController;


Route::get('/tips', [TipController::class, 'getTips']);


// ROute pour rappel de medicament

Route::get('/pilrembers', [PilremberController::class, 'getRemenbers']);
Route::post('/pilrembers', [PilremberController::class, 'storeRemenber']);
Route::delete('/pilrembers/{pilrember}', [PilremberController::class, 'deleteRemenber']);

