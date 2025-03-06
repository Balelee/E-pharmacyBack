<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'getUsers']);
Route::post('/users', [UserController::class, 'storeUser']);
Route::put('/users/{user}', [UserController::class, 'updateUser']);
Route::get('/users/{user}', [UserController::class, 'findUser']);
Route::delete('/users/{user}', [UserController::class, 'deleteUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::post('/verifyOtp', [UserController::class, 'verifyOtp']);

// --------------------- Auth Google Account --------------------

Route::get('/auth/google', [UserController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback']);
