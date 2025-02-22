<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Index route
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index']);

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('/private')->group(function () {
        Route::get('/dashboard', [UserController::class, 'private-index'])->name('dashboard');
    })->name('private');
});

Route::get('/about-us', [InfoController::class, 'about_us'])->name('about-us');
