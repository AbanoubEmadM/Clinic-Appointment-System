<?php
use App\Http\Controllers\Api\V1\Patient\AppointmentController;
use App\Http\Controllers\Api\V1\Patient\VisitController;
use App\Http\Controllers\Api\V1\Patient\InvoiceController;
use App\Http\Controllers\Api\V1\Patient\ReviewController;

Route::middleware(['auth:sanctum', 'role:patient'])
    ->prefix('patient')
    ->group(function () {
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('visits', VisitController::class);
    Route::apiResource('payments', InvoiceController::class);
    Route::apiResource('reviews', ReviewController::class);

});
