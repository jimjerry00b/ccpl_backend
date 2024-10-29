<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('login.index');
    Route::get('/login', [AdminController::class, 'index'])->name('login.index');
    Route::post('/login', [AdminController::class, 'login'])->name('login');
});

Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
});
