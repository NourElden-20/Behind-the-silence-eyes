<?php
namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;


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
Route::get('/dashboard',[DashboardController::class,'index'] )->name('dashboard');