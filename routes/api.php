<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicalSessionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('patients', PatientController::class);
    
    Route::apiResource('medical_sessions', MedicalSessionController::class);

    Route::apiResource('payments', PaymentController::class);

});