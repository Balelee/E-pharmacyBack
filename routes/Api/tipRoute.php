<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;


Route::get('/tips', [TipController::class, 'getTips']);
