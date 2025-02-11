<?php

use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\OriginController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\TerminalController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('origins', OriginController::class);
    Route::apiResource('destinations', DestinationController::class);

    //  برای گرفتن ترمینال‌ها بر اساس کد شهر
    Route::get('terminals-by-code', [TerminalController::class, 'getTerminalsByCityCode']);
    Route::apiResource('terminals', TerminalController::class);

    Route::apiResource('trips', TripController::class);

    Route::get('search', [SearchController::class, 'search']);

    Route::post('reserve', [ReservationController::class, 'reserve']);  // رزرو کردن
    Route::put('reserve/{id}/cancel', [ReservationController::class, 'cancel']);




});


