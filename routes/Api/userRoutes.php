<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'getUsers']);
Route::post('/users', [UserController::class, 'storeUser']);
Route::put('/users/{user}', [UserController::class, 'updateUser']);
Route::get('/users/{user}', [UserController::class, 'findUser']);
Route::delete('/users/{user}', [UserController::class, 'deleteUser']);
Route::post('/login', [UserController::class, 'loginUser']);
