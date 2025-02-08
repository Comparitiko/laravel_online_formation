<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    // Courses routes
    Route::prefix('/courses')->group(function () {
        Route::get('/', [CourseController::class, 'api_index']);
        Route::get('/${id}', [CourseController::class, 'api_show']);
        Route::post('/', [CourseController::class, 'api_create']);
        Route::delete('/${id}', [CourseController::class, 'api_delete']);
    });

    // Students routes
    Route::prefix('/students')->group(function () {
        Route::get('${dni}/registrations', [UserController::class, 'api_show_all_registrations']);
    });

    // Registrations routes
    Route::prefix('/registrations')->group(function () {
        Route::post('/', [UserController::class, 'api_new_registration']);
        Route::delete('/${id}', [UserController::class, 'api_delete_registration']);
    });

})->middleware('auth:sanctum');
