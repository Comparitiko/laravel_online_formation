<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Routes prefixed by /v1
Route::prefix('/v1')->group(function () {

    // Private routes
    Route::middleware('auth:sanctum')->group(function () {
        // Courses routes
        Route::prefix('/courses')->group(function () {
            // Anyone can see this routes
            Route::get('/', [CourseController::class, 'api_index']);
            Route::get('/{course}', [CourseController::class, 'api_show']);

            // Only admins can create and delete courses
            Route::post('/', [CourseController::class, 'api_create']);
            Route::delete('/{course}', [CourseController::class, 'api_delete']);
        });

        // Students routes
        Route::prefix('/students')->group(function () {
            // Only admins and the student that owns the registration can see this routes
            Route::get('/{dni}/registrations', [UserController::class, 'api_show_all_registrations']);
            Route::delete('/{dni}/registrations/{course_id}', [UserController::class, 'api_cancel_registration']);
        });

        // Registrations routes
        Route::prefix('/registrations')->group(function () {
            // User that owns the registration can create and delete registrations
            Route::post('/', [RegistrationController::class, 'api_new_registration']);
        });
    });

    // Public routes
    Route::post('/login', [UserController::class, 'api_login']);
    Route::post('/register', [UserController::class, 'api_register']);
});
