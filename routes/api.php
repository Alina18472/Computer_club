<?php

use App\Http\Controllers\AdditionalMenuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingTariffController;
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

Route::get('additional-menu', [AdditionalMenuController::class, 'index'])->middleware('basic.admin');
Route::post('additional-menu', [AdditionalMenuController::class, 'store'])->middleware('basic.user');
Route::get('additional-menu/{id}', [AdditionalMenuController::class, 'show'])->middleware('basic.user');

Route::get('bookings', [BookingController::class, 'index'])->middleware('basic.admin');
Route::post('bookings', [BookingController::class, 'store'])->middleware('basic.user');
Route::patch('bookings/{id}', [BookingController::class, 'update'])->middleware('basic.user');
Route::get('bookings/{id}', [BookingController::class, 'show'])->middleware('basic.user');
Route::get('bookings/computers/{computer_id}/{day}', [BookingController::class, 'getOrderedDatesFromComputerIdAndDay'])->middleware('basic.admin');
Route::get('bookings/{id}/full-info', [BookingController::class, 'getFullInfo'])->middleware('basic.user');

Route::apiResource('codes', CodeController::class)->middleware('basic.admin');

Route::get('computers', [ComputerController::class, 'index']);
Route::get('computers/{id}', [ComputerController::class, 'show']);
Route::post('computers', [ComputerController::class, 'store'])->middleware('basic.admin');
Route::patch('computers/{id}', [ComputerController::class, 'update'])->middleware('basic.admin');
Route::delete('computers/{id}', [ComputerController::class, 'destroy'])->middleware('basic.admin');

Route::get('computer-positions', [ComputerPositionController::class, 'index']);
Route::get('computer-positions/{id}', [ComputerPositionController::class, 'show']);
Route::post('computer-positions', [ComputerPositionController::class, 'store'])->middleware('basic.admin');
Route::patch('computer-positions/{id}', [ComputerPositionController::class, 'update'])->middleware('basic.admin');
Route::delete('computer-positions/{id}', [ComputerPositionController::class, 'destroy'])->middleware('basic.admin');
Route::get('computer-positions/{club_id}/clubs', [ComputerPositionController::class, 'getByClubId']);
Route::get('computer-positions/{room_id}/rooms', [ComputerPositionController::class, 'getByRoomId']);

Route::get('computer-specs', [ComputerSpecController::class, 'index']);
Route::get('computer-specs/{id}', [ComputerSpecController::class, 'show']);
Route::post('computer-specs', [ComputerSpecController::class, 'store'])->middleware('basic.admin');
Route::patch('computer-specs/{id}', [ComputerSpecController::class, 'update'])->middleware('basic.admin');
Route::delete('computer-specs/{id}', [ComputerSpecController::class, 'destroy'])->middleware('basic.admin');

Route::get('foods', [FoodController::class, 'index']);
Route::get('foods/{id}', [FoodController::class, 'show']);
Route::post('foods', [FoodController::class, 'store'])->middleware('basic.admin');
Route::patch('foods/{id}', [FoodController::class, 'update'])->middleware('basic.user');
Route::delete('foods/{id}', [FoodController::class, 'destroy'])->middleware('basic.admin');
Route::get('foods/{club_id}/clubs', [FoodController::class, 'getByClubId']);

Route::get('users', [UserController::class, 'index'])->middleware('basic.superadmin');
Route::post('users', [UserController::class, 'store']);
Route::patch('users/{user_id}', [UserController::class, 'update'])->middleware('basic.user');
Route::delete('users/{user_id}', [UserController::class, 'destroy'])->middleware('basic.user');
Route::get('users/{user_id}', [UserController::class, 'show'])->middleware('basic.user');
Route::get('users/{user_id}/bookings', [UserController::class, 'bookings'])->middleware('basic.user');
Route::post('login', [UserController::class, 'login']);

Route::apiResource('booking-tariffs', BookingTariffController::class);

Route::get('tariffs', [TariffController::class, 'index']);
Route::get('tariffs/{id}', [TariffController::class, 'show']);
Route::post('tariffs', [TariffController::class, 'store'])->middleware('basic.admin');
Route::patch('tariffs/{id}', [TariffController::class, 'update'])->middleware('basic.admin');
Route::delete('tariffs/{id}', [TariffController::class, 'destroy'])->middleware('basic.admin');

Route::get('payments', [PaymentController::class, 'index'])->middleware('basic.admin');
Route::post('payments', [PaymentController::class, 'store'])->middleware('basic.user');
Route::get('payments/{id}', [PaymentController::class, 'show'])->middleware('basic.user');
Route::get('payments/{user_id}/users', [PaymentController::class, 'getByUserId'])->middleware('basic.user');

Route::get('clubs', [ClubController::class, 'index']);
Route::get('clubs/{id}', [ClubController::class, 'show']);
Route::post('clubs', [ClubController::class, 'store'])->middleware('basic.superadmin');
Route::patch('clubs/{id}', [ClubController::class, 'update'])->middleware('basic.superadmin');
Route::delete('clubs/{id}', [ClubController::class, 'destroy'])->middleware('basic.superadmin');

Route::get('rooms', [RoomController::class, 'index']);
Route::get('rooms/{id}', [RoomController::class, 'show']);
Route::post('rooms', [RoomController::class, 'store'])->middleware('basic.superadmin');
Route::patch('rooms/{id}', [RoomController::class, 'update'])->middleware('basic.superadmin');
Route::delete('rooms/{id}', [RoomController::class, 'destroy'])->middleware('basic.superadmin');
Route::get('rooms/{club_id}/clubs', [RoomController::class, 'getByClubId']);
