<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PatientAuthController;
use App\Http\Controllers\Web\PatientController;
use App\Http\Controllers\Web\PredectionController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public & Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/patient-login', [PatientAuthController::class, 'showLogin'])->name('patient.login');
    Route::post('/patient-login', [PatientAuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Shared Routes (الراوتات المشتركة بين الدكتور والمريض)
|--------------------------------------------------------------------------
*/
// بنستخدم auth:web,patient عشان نسمح للجارد بتاع الدكتور وبتاع المريض يدخلوا
Route::middleware(['auth:web,patient'])->group(function () {
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
});


/*
|--------------------------------------------------------------------------
| Patient Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientAuthController::class, 'dashboard'])->name('patient.dashboard');
    Route::post('/patient/logout', [PatientAuthController::class, 'logout'])->name('patient.logout');
});

/*
|--------------------------------------------------------------------------
| Doctor/Admin Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:web')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', function () {
        $doctor = auth()->user();
        return view('auth.profile', compact('doctor'));
    })->name('auth.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('auth.profile.update');

    Route::prefix('/patients')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('patients.index');
        Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
        Route::post('/store', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/{id}', [PatientController::class, 'show'])->name('patients.show');
        Route::get('/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::post('/{id}/update', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/{id}/delete', [PatientController::class, 'destroy'])->name('patients.delete');
    });

    Route::prefix('/predictions')->group(function () {
        Route::get('/create/{id}', [PredectionController::class, 'create'])->name('predictions.create');
        Route::post('/store', [PredectionController::class, 'store'])->name('predictions.store');
        Route::get('/result/{id}', [PredectionController::class, 'result'])->name('predictions.result');
        Route::get('/history/{id}', [PredectionController::class, 'history'])->name('predictions.history');
    });

    Route::prefix('/reports')->group(function () {
        // شيلنا راوت show من هنا لأنه بقى في المشترك فوق
        Route::post('/{id}/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::get('/dashboard/report', [ReportController::class, 'generateReportDashboard'])->name('reports.dashboard');
    });

});

/*
|--------------------------------------------------------------------------
| Admin Specific Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:web', 'role:admin'])->prefix('/doctors')->group(function () {
    Route::get('/', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/store', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/{id}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::get('/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::post('/{id}/update', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/{id}/delete', [DoctorController::class, 'destroy'])->name('doctors.delete');
});

/*
|--------------------------------------------------------------------------
| Password Recovery Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT ? back()->with('success', __($status)) : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate(['token' => 'required', 'email' => 'required|email', 'password' => 'required|min:8|confirmed']);
        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill(['password' => bcrypt($password)])->save();
        });
        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('success', 'Password reset successfully') : back()->withErrors(['email' => __($status)]);
    })->name('password.update');
});