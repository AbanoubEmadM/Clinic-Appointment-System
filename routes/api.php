<?php

use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
//    Route::apiResource('doctors', [DoctorController::class]);
      Route::prefix('auth')->group(function () {
          Route::post('register', RegisterController::class);
          Route::post('login', LoginController::class)->middleware(['throttle:5,1']);
          Route::post('logout', LogoutController::class)->middleware(['auth:sanctum']);
      });
});
