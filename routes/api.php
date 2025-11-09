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
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('additional-menu', AdditionalMenuController::class);

Route::apiResource('bookings', BookingController::class);
Route::get('/bookings/computers/{computer_id}/{day}', [BookingController::class, 'getOrderedDatesFromComputerIdAndDay']);
Route::get('/bookings/{id}/full-info', [BookingController::class, 'getFullInfo']);

Route::apiResource('codes', CodeController::class);

Route::apiResource('computers', ComputerController::class);

Route::apiResource('computer-positions', ComputerPositionController::class);
Route::get('/computer-positions/{club_id}/clubs', [ComputerPositionController::class, 'getByClubId']);
Route::get('/computer-positions/{room_id}/rooms', [ComputerPositionController::class, 'getByRoomId']);

Route::apiResource('computer-specs', ComputerSpecController::class);

Route::apiResource('foods', FoodController::class);
Route::get('/foods/{club_id}/clubs', [FoodController::class, 'getByClubId']);

Route::apiResource('users', UserController::class)->except(['destroy']);
Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware('basic.admin');
Route::get('/users/{id}/bookings', [UserController::class, 'bookings']);
Route::post('/login', [UserController::class, 'login']);

Route::apiResource('tariffs', TariffController::class);

Route::apiResource('payments', PaymentController::class);

Route::apiResource('clubs', ClubController::class);

Route::apiResource('rooms', RoomController::class);
Route::get('/rooms/{club_id}/clubs', [RoomController::class, 'getByClubId']);
