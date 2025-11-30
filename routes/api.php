<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Broadcast::routes(['middleware' => ['auth:sanctum', 'accept.user.lang']]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['accept.user.lang'])->group(function () {
    require __DIR__ . '/Api/dataRoutes.php';
    require __DIR__ . '/Api/userRoutes.php';
    require __DIR__ . '/Api/productRoutes.php';
    require __DIR__ . '/Api/pharmacyRoutes.php';
    require __DIR__ . '/Api/orderRoutes.php';
    require __DIR__ . '/Api/orderdetailRoutes.php';
    require __DIR__ . '/Api/payementRoutes.php';
    require __DIR__ . '/Api/tipRoute.php';
});
