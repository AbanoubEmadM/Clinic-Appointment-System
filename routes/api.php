<?php
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__ . '/auth.php';
    require __DIR__.'/admin.php';
    require __DIR__.'/doctor.php';
    require __DIR__.'/patient.php';
    require __DIR__.'/receptionist.php';
});
