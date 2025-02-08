<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    // Courses routes
    Route::prefix('/courses')->group(function () {
        Route::get('/', [CourseController::class => 'api_index']);
        Route::get('/${id}', CourseController::class);
    });

    // Students routes
    Route::prefix('/students')->group(function () {

    });

    // Registrations routes
    Route::prefix('/registrations')->group(function () {

    });

});
