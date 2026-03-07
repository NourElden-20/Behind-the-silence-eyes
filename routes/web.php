<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
Route::get('/patient', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', function () {
    return view('patients.create');
});

Route::prefix('/patient')->group(function () {
    Route::get('/create', [PatientController::class, 'create'])->name('patient.create');
    Route::post('/store', [PatientController::class, 'store'])->name('patient.store');
    Route::get('/index', [PatientController::class, 'index'])->name('patient.index');
    Route::get('/showdetails/{id}', [PatientController::class, 'show'])->name('patient.show');
    Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit');
    Route::post('/update/{id}', [PatientController::class, 'update'])->name('patient.update');
    Route::delete('/delete/{id}', [PatientController::class, 'destroy'])->name('patient.delete');
});

Route::prefix('/prediction')->group(function () {
    Route::get('/create/{id}', [PredectionController::class, 'create'])->name('prediction.create');
    Route::post('/store', [PredectionController::class, 'store'])->name('prediction.store');
});
