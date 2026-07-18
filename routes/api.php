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

    Route::prefix('auth')->group(function () {
        Route::post('register', RegisterController::class);
        Route::post('login', LoginController::class)->middleware(['throttle:5,1']);
        Route::post('logout', LogoutController::class)->middleware(['auth:sanctum']);
    });
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::apiResource('/admin/patients', \App\Http\Controllers\Api\V1\Admin\PatientController::class);
        Route::patch('/admin/patients/{patient}/activate', [\App\Http\Controllers\Api\V1\Admin\PatientController::class, 'activate']);
        Route::patch('/admin/patients/{patient}/deactivate', [\App\Http\Controllers\Api\V1\Admin\PatientController::class, 'deactivate']);

        Route::apiResource('/admin/doctors', \App\Http\Controllers\Api\V1\Admin\DoctorController::class);
        Route::patch('/admin/doctors/{doctor}/activate', [\App\Http\Controllers\Api\V1\Admin\DoctorController::class, 'activate']);
        Route::patch('/admin/doctors/{doctor}/deactivate', [\App\Http\Controllers\Api\V1\Admin\DoctorController::class, 'deactivate']);

        Route::apiResource('/admin/receptionists', \App\Http\Controllers\Api\V1\Admin\ReceptionistController::class);
        Route::patch('/admin/receptionists/{receptionist}/activate', [\App\Http\Controllers\Api\V1\Admin\ReceptionistController::class, 'activate']);
        Route::patch('/admin/receptionists/{receptionist}/deactivate', [\App\Http\Controllers\Api\V1\Admin\ReceptionistController::class, 'deactivate']);

        Route::apiResource('/admin/appointments', \App\Http\Controllers\Api\V1\Admin\AppointmentController::class)
        ->only(['index', 'show']);

        Route::apiResource('/admin/visits', \App\Http\Controllers\Api\V1\Admin\VisitController::class)
        ->only(['index', 'show']);

        Route::apiResource('/admin/invoices', \App\Http\Controllers\Api\V1\Admin\InvoiceController::class)
        ->only(['index', 'show']);

        Route::apiResource('/admin/payments', \App\Http\Controllers\Api\V1\Admin\PaymentController::class)
        ->only(['index', 'show']);
//        Route::apiResource('/admin/patients', \App\Http\Controllers\Api\V1\Admin\DashboardController::class);

    });

    Route::middleware(['auth:sanctum', 'role:doctor'])->group(function () {
    });

    Route::middleware(['auth:sanctum', 'role:receptionist'])->group(function () {
    });

    Route::middleware(['auth:sanctum', 'role:patient'])->group(function () {
    });

});
