<?php

use App\Http\Controllers\Api\V1\Admin\DoctorReviewController;
use App\Http\Controllers\Api\V1\Admin\PatientController;
use App\Http\Controllers\Api\V1\Admin\DoctorController;
use App\Http\Controllers\Api\V1\Admin\VisitController;
use App\Http\Controllers\Api\V1\Admin\PaymentController;
use App\Http\Controllers\Api\V1\Admin\InvoiceController;
use App\Http\Controllers\Api\V1\Admin\ReceptionistController;
use App\Http\Controllers\Api\V1\Admin\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::apiResource('patients', PatientController::class);

        Route::patch('patients/{patient}/status', [PatientController::class, 'updateStatus']);

        Route::apiResource('doctors', DoctorController::class);

        Route::patch('doctors/{doctor}/status', [DoctorController::class, 'updateStatus']);

        Route::apiResource('receptionists', ReceptionistController::class);

        Route::patch('receptionists/{receptionist}/status', [ReceptionistController::class, 'updateStatus']);

        Route::apiResource('reviews', DoctorReviewController::class)
            ->except(['store', 'update']);

        Route::apiResource('appointments', AppointmentController::class)
            ->only(['index', 'show']);

        Route::apiResource('visits', VisitController::class)
            ->only(['index', 'show']);

        Route::apiResource('invoices', InvoiceController::class)
            ->only(['index', 'show']);

        Route::apiResource('payments', PaymentController::class)
            ->only(['index', 'show']);
    });
