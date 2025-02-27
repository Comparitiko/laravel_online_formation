<?php

use App\Enums\UserRole;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Index route
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');

    // Only verified users can enter here
    Route::middleware('verified')->group(function () {
        Route::prefix('/profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/', [ProfileController::class, 'edit'])->name('edit');
                Route::patch('/', [ProfileController::class, 'update'])->name('update');
                Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
            });

        Route::middleware('role:'.UserRole::STUDENT->value)
            ->group(function () {
                // Web side here
            });

        // Private routes
        Route::prefix('/private')
            ->name('private.')
            ->middleware('role:'.UserRole::TEACHER->value)
            ->group(function () {
                // Courses routes
                Route::prefix('/courses')
                    ->name('courses.')
                    ->group(function () {
                        // Index courses route
                        Route::get('/', [CourseController::class, 'private_courses'])
                            ->name('index');

                        // Create course routes
                        Route::get('/create', [CourseController::class, 'private_create_courses_form'])
                            ->name('create');
                        Route::post('/', [CourseController::class, 'private_create_courses'])
                            ->name('create');

                        // Edit course routes
                        Route::get('/{course}/edit', [CourseController::class, 'private_edit_course_form'])
                            ->name('edit');
                        Route::post('/{course}/edit', [CourseController::class, 'private_edit_course'])
                            ->name('edit');

                        // Delete course route
                        Route::get('/{course}/delete', [CourseController::class, 'private_delete_course'])
                            ->name('delete');

                        // Finish course route
                        Route::get('/{course}/finish', [CourseController::class, 'private_finish_course'])
                            ->name('finish');

                        // Add material to course route
                        Route::get('/{course}/add-material', [CourseController::class, 'private_add_material_course'])
                            ->name('add-material');
                    });

                // Registrations routes
                Route::prefix('registration')
                    ->name('registrations.')
                    ->group(function () {
                        // Index registration route
                        Route::get('/', [RegistrationController::class, 'private_registrations'])
                            ->name('index');

                        // Confirm registration route
                        Route::get('/{registration}/confirm', [RegistrationController::class, 'private_confirm_registration'])
                            ->name('confirm');

                        // Cancel registration route
                        Route::get('/{registration}/cancel', [RegistrationController::class, 'private_cancel_registration'])
                            ->name('cancel');
                    });

                // Evaluations routes
                Route::prefix('/evaluations')
                    ->name('evaluations.')
                    ->group(function () {
                        // Index evaluations route // Show all evaluations for admins and show only evaluable
                        // students and courses
                        Route::get('/', [EvaluationController::class, 'private_evaluations'])
                            ->name('index')
                            ->middleware('role:'.UserRole::ADMIN->value);

                        // Create evaluations routes
                        Route::get('/create', [EvaluationController::class, 'private_create_evaluation_form'])
                            ->name('create');
                        Route::post('/', [EvaluationController::class, 'private_create_evaluation'])
                            ->name('create');
                    });

                //  Users routes
                Route::prefix('/users')
                    ->name('users.')
                    ->middleware('role:' .UserRole::ADMIN->value)
                    ->group(function () {
                        // Users index route
                        Route::get('/users', [UserController::class, 'private_users'])
                            ->name('index');

                        // Create user routes
                        Route::get('/create', [UserController::class, 'private_create_user_form'])
                            ->name('create');
                        Route::post('/', [UserController::class, 'private_create_user'])
                            ->name('create');

                        // Delete user route
                        Route::get('/{user}/delete', [UserController::class, 'private_delete_user'])
                            ->name('create');
                    });
            });
    });
});

Route::get('/about-us', [InfoController::class, 'about_us'])->name('about-us');
