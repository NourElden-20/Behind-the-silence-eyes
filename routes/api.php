<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DoctorApiController;
use App\Http\Controllers\Api\PatientApiController;
use App\Http\Controllers\Api\PatientAuthApiController;
use App\Http\Controllers\Api\PredictionApiController;
use App\Http\Controllers\Api\ReportApiController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/auth/login', [AuthApiController::class, 'login'])->name('api.auth.login');

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/auth/logout', [AuthApiController::class, 'logout'])->name('api.auth.logout');
    Route::get('/auth/me', [AuthApiController::class, 'me'])->name('api.auth.me');
    Route::put('/auth/profile', [AuthApiController::class, 'update'])->name('api.auth.updateProfile');

    // Patient Auth
    Route::post('/patient/login', [PatientAuthApiController::class, 'login']);

    Route::middleware('auth.patient.api')->group(function () {
        Route::get('/patient/profile', [PatientAuthApiController::class, 'profile']);
        Route::get('/patient/diagnoses', [PatientAuthApiController::class, 'diagnoses']);
        Route::get('/patient/reports', [PatientAuthApiController::class, 'reports']);
        Route::post('/patient/logout', [PatientAuthApiController::class, 'logout']);
    });

    // Patients
    Route::get('/mobile/patients', [PatientApiController::class, 'index'])->name('api.patients.index');
    Route::post('/mobile/patients', [PatientApiController::class, 'store'])->name('api.patients.store');
    Route::get('/mobile/patients/{id}', [PatientApiController::class, 'show'])->name('api.patients.show');
    Route::put('/mobile/patients/{id}', [PatientApiController::class, 'update'])->name('api.patients.update');
    Route::delete('/mobile/patients/{id}', [PatientApiController::class, 'destroy'])->name('api.patients.destroy');

    // Predictions
    Route::post('/mobile/predictions/{type}', [PredictionApiController::class, 'store'])->name('api.predictions.store');
    Route::get('/mobile/predictions/history/{patient_id}', [PredictionApiController::class, 'history'])->name('api.predictions.history');
    Route::get('/mobile/predictions/{id}', [PredictionApiController::class, 'result'])->name('api.predictions.result');
    // Reports
    Route::get('/mobile/reports/{id}', [ReportApiController::class, 'show'])->name('api.reports.show');
    Route::post('/mobile/reports/{id}/generate', [ReportApiController::class, 'generate'])->name('api.reports.generate');

    // Admin Only
    Route::middleware('role:admin')->group(function () {
        Route::get('/mobile/doctors', [DoctorApiController::class, 'index'])->name('api.doctors.index');
        Route::post('/mobile/doctors', [DoctorApiController::class, 'store'])->name('api.doctors.store');
        Route::get('/mobile/doctors/{id}', [DoctorApiController::class, 'show'])->name('api.doctors.show');
        Route::put('/mobile/doctors/{id}', [DoctorApiController::class, 'update'])->name('api.doctors.update');
        Route::delete('/mobile/doctors/{id}', [DoctorApiController::class, 'destroy'])->name('api.doctors.destroy');
    });

});
