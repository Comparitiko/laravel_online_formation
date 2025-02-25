<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Index route
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/private')->name('private.')->group(function () {
        Route::get('/courses', [CourseController::class, 'private_courses'])->name('courses');
    });
});

Route::get('/about-us', [InfoController::class, 'about_us'])->name('about-us');
