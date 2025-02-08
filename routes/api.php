<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    // Courses routes
    Route::prefix('/courses')->group(function () {
        Route::get('/', [CourseController::class => 'api_index']);
        Route::get('/${id}', [CourseController::class => 'api_show']);
    });

    // Students routes
    Route::prefix('/students')->group(function () {
        return "hola";
    });

    // Registrations routes
    Route::prefix('/registrations')->group(function () {
        return "hola";
    });

});
