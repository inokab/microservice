<?php

use App\Http\Controllers\Api\CreateOrderController;
use App\Http\Controllers\Api\ListOrderController;
use App\Http\Controllers\Api\UpdateOrderStatusController;
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

Route::prefix('/orders')->group(function () {
    Route::post('/create', CreateOrderController::class);
    Route::post('/list', ListOrderController::class);
    Route::post('/update', UpdateOrderStatusController::class);
});

