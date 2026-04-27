<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DoctorApiController;
use App\Http\Controllers\Api\PatientApiController;
use App\Http\Controllers\Api\PatientAuthApiController;
use App\Http\Controllers\Api\PredictionApiController;
use App\Http\Controllers\Api\ReportApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API Routes (No Token Required)
|--------------------------------------------------------------------------
*/

// Doctor/Admin Login
Route::post('/auth/login', [AuthApiController::class, 'login'])->name('api.auth.login');

// Patient Login (National ID)
Route::post('/patient/login', [PatientAuthApiController::class, 'login'])->name('api.patient.login');

/*
|--------------------------------------------------------------------------
| Protected API Routes (Requires Sanctum Token)
|--------------------------------------------------------------------------
*/

// ملحوظة: Sanctum هيعرف لوحده التوكن ده بتاع مريض ولا دكتور بناءً على الـ Model المرتبط بالتوكن
Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Shared Routes (Shared between Patients & Doctors)
    |--------------------------------------------------------------------------
    | راوتات عرض التقارير والنتائج لازم تكون متاحة للطرفين
    */
    Route::get('/mobile/reports/{id}', [ReportApiController::class, 'show'])->name('api.reports.show');
    Route::get('/mobile/predictions/{id}', [PredictionApiController::class, 'result'])->name('api.predictions.result');


    /*
    |--------------------------------------------------------------------------
    | Patient ONLY Routes
    |--------------------------------------------------------------------------
    | هذه المسارات لا يفتحها إلا المريض (باستخدام التوكن الخاص به)
    */
    // تأكد أن الميدل وير auth.patient.api بيفحص الـ Guard الخاص بالمريض
    Route::middleware('auth.patient.api')->group(function () {
        Route::get('/patient/profile', [PatientAuthApiController::class, 'profile']);
        Route::get('/patient/diagnoses', [PatientAuthApiController::class, 'diagnoses']);
        Route::post('/patient/logout', [PatientAuthApiController::class, 'logout']);
    });


    /*
    |--------------------------------------------------------------------------
    | Doctor ONLY Operations
    |--------------------------------------------------------------------------
    | المسارات دي خاصة بالدكاترة بس (CRUD المرضى، التوقعات، إلخ)
    */
    Route::middleware('role:doctor,admin')->group(function () {
        
        // Auth Actions for Doctors
        Route::post('/auth/logout', [AuthApiController::class, 'logout'])->name('api.auth.logout');
        Route::get('/auth/me', [AuthApiController::class, 'me'])->name('api.auth.me');
        Route::put('/auth/profile', [AuthApiController::class, 'update'])->name('api.auth.updateProfile');

        // Manage Patients
        Route::get('/mobile/patients', [PatientApiController::class, 'index'])->name('api.patients.index');
        Route::post('/mobile/patients', [PatientApiController::class, 'store'])->name('api.patients.store');
        Route::get('/mobile/patients/{id}', [PatientApiController::class, 'show'])->name('api.patients.show');
        Route::put('/mobile/patients/{id}', [PatientApiController::class, 'update'])->name('api.patients.update');
        Route::delete('/mobile/patients/{id}', [PatientApiController::class, 'destroy'])->name('api.patients.destroy');

        // AI Predictions (Diagnosis)
        Route::post('/mobile/predictions/{type}', [PredictionApiController::class, 'store'])->name('api.predictions.store');
        Route::get('/mobile/predictions/history/{patient_id}', [PredictionApiController::class, 'history'])->name('api.predictions.history');
        Route::post('/mobile/reports/{id}/generate', [ReportApiController::class, 'generate'])->name('api.reports.generate');
    });


    /*
    |--------------------------------------------------------------------------
    | Admin ONLY Operations
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::get('/mobile/doctors', [DoctorApiController::class, 'index'])->name('api.doctors.index');
        Route::post('/mobile/doctors', [DoctorApiController::class, 'store'])->name('api.doctors.store');
        Route::get('/mobile/doctors/{id}', [DoctorApiController::class, 'show'])->name('api.doctors.show');
        Route::put('/mobile/doctors/{id}', [DoctorApiController::class, 'update'])->name('api.doctors.update');
        Route::delete('/mobile/doctors/{id}', [DoctorApiController::class, 'destroy'])->name('api.doctors.destroy');
    });

});