<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PatientController;
use App\Http\Controllers\Web\ReportController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Web\PredectionController;

// ─────────────────────────────────────────
// Guest Routes (مش محتاج يكون لوقن)
// ─────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ─────────────────────────────────────────
// Auth Routes (لازم يكون لوقن)
// ─────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Patients
    Route::prefix('/patients')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('patients.index');
        Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
        Route::post('/store', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/{id}', [PatientController::class, 'show'])->name('patients.show');
        Route::get('/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::post('/{id}/update', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/{id}/delete', [PatientController::class, 'destroy'])->name('patients.delete');
    });

    // Predictions
    Route::prefix('/predictions')->group(function () {
        Route::get('/create/{id}', [PredectionController::class, 'create'])->name('predictions.create');
        Route::post('/store', [PredectionController::class, 'store'])->name('predictions.store');
    });

    // Reports
    Route::prefix('/reports')->group(function () {
        Route::get('/{id}', [ReportController::class, 'show'])->name('reports.show');
        Route::post('/{id}/generate', [ReportController::class, 'generate'])->name('reports.generate');
    });

});

// ─────────────────────────────────────────
// Admin Routes (لازم يكون أدمن)
// ─────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('/doctors')->group(function () {
    Route::get('/', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/store', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/{id}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::get('/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::post('/{id}/update', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/{id}/delete', [DoctorController::class, 'destroy'])->name('doctors.delete');
});
