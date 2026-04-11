<?php

use App\Http\Controllers\VisitsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('internal')->group(function () {
    Route::post('/visits', [VisitsController::class, 'store']);
    Route::get('/visits/{id}', [VisitsController::class, 'show']);
    Route::get('/patients/{patientId}/records', [VisitsController::class, 'patientRecords']);
});
