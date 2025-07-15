<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;
use App\Http\Controllers\PilremberController;


Route::get('/tips', [TipController::class, 'getTips']);


// ROute pour rappel de medicament

Route::get('/remenbers', [PilremberController::class, 'getRemenbers']);
Route::post('/remenbers', [PilremberController::class, 'storeRemenber']);

