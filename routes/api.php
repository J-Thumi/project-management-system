<?php

use App\Http\Controllers\Api\DailyLogController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\QuotationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Projects & Stages
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::patch('/projects/{id}', [ProjectController::class, 'update']);
    Route::patch('/projects/{project}/stages/{stage}', [ProjectController::class, 'updateStage']);

    // Quotations
    Route::post('/quotations', [QuotationController::class, 'store']);
    Route::get('/quotations/{id}', [QuotationController::class, 'show']);

    // Site Daily Logs
    Route::post('/daily-logs', [DailyLogController::class, 'store']);
});