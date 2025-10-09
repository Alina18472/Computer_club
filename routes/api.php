<?php

use App\Http\Controllers\AdditionalMenuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ComputerPositionController;
use App\Http\Controllers\ComputerSpecController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('additional-menu', AdditionalMenuController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('codes', CodeController::class);
Route::apiResource('computers', ComputerController::class);
Route::apiResource('computer-positions', ComputerPositionController::class);
Route::apiResource('computer-specs', ComputerSpecController::class);
Route::apiResource('foods', FoodController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('tariffs', TariffController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('clubs', ClubController::class);
