<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Courses routes
    Route::prefix('courses')->group(function () {

    });

    // Students routes
    Route::prefix('students')->group(function () {

    });

    // Registrations routes
    Route::prefix('registrations')->group(function () {

    });

});
