<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'getUsers']);
    Route::post('/register', [UserController::class, 'storeUser']);
    Route::put('/{user}', [UserController::class, 'updateUser']);
    Route::get('/{user}', [UserController::class, 'findUser']);
    Route::delete('/{user}', [UserController::class, 'deleteUser']);
    Route::post('/login', [UserController::class, 'loginUser']);
    Route::post('/verifyOtp', [UserController::class, 'verifyOtp']);
    // --------------------- ROUTES PROTEGER --------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserController::class, 'logoutUser']);
    });
});

// --------------------- Auth Google Account --------------------

Route::get('/auth/google', [UserController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback']);
