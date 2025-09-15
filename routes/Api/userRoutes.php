<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('users')->group(function () {
    Route::post('/register', [UserController::class, 'storeUser']);
    Route::put('/{user}', [UserController::class, 'updateUser']);
    Route::get('/{user}', [UserController::class, 'findUser']);
    Route::delete('/{user}', [UserController::class, 'deleteUser']);
    Route::post('/login', [UserController::class, 'loginUser']);
    // Route::post('/verifyOtp', [UserController::class, 'verifyOtp']);
    // --------------------- ROUTES PROTEGER --------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserController::class, 'logoutUser']);
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'getUsers']);
     Route::put('/users/{user}', [UserController::class, 'updateUserByAdmin']);
});
// --------------------- Auth Google Account --------------------

// Route::get('/auth/google', [UserController::class, 'redirectToGoogle']);
// Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback']);
