<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HolidayPlanController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/validate-token', [AuthController::class, 'validateToken']);

    Route::post('/holidayplans', [HolidayPlanController::class, 'store']);
    Route::get('/holidayplans', [HolidayPlanController::class, 'index']);
    Route::get('/participants', [HolidayPlanController::class, 'get']);
});
