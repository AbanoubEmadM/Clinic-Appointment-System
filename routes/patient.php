<?php
use App\Http\Controllers\Api\V1\Patient\AppointmentController;

Route::middleware(['auth:sanctum', 'role:patient'])
    ->prefix('patient')
    ->group(function () {
    Route::apiResource('appointments', AppointmentController::class);
});
