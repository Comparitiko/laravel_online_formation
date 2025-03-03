<?php

use App\Enums\UserRole;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// About us route
Route::get('/about-us', [InfoController::class, 'about_us'])->name('about-us');

Route::middleware('auth')->group(function () {
    // Index route
    Route::get('/', [UserController::class, 'index'])->name('index');

    // Only verified users can enter here
    Route::middleware('verified')->group(function () {
        Route::prefix('/profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/', [ProfileController::class, 'edit'])->name('edit');
                Route::patch('/', [ProfileController::class, 'update'])->name('update');
                Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
                Route::post('/generate-token', [ProfileController::class, 'generate_token'])->name('generate-token');
            });

        // Public web routes
        Route::prefix('/students')
            ->name('students.')
            ->middleware('role:'.UserRole::STUDENT->value)
            ->group(function () {
                // Courses routes
                Route::prefix('/courses')
                    ->name('courses.')
                    ->group(function () {
                        // Index courses route
                        Route::get('/', [CourseController::class, 'public_course_index'])
                            ->name('index');

                        // Registered courses route
                        Route::get('/registered', [CourseController::class, 'public_course_registered'])
                            ->name('registered');

                        // Material courses route
                        Route::get('/{course}/materials', [CourseMaterialController::class, 'public_course_materials'])
                            ->name('materials');
                    });

                // Registrations routes
                Route::prefix('/registrations')
                    ->name('registrations.')
                    ->group(function () {
                        // Create registration to a course
                        Route::get('/{course}')
                            ->name('create');
                    });
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
                            ->name('create-form');
                        Route::post('/', [CourseController::class, 'private_create_courses'])
                            ->name('create');

                        // Edit course routes
                        Route::get('/{course}/edit', [CourseController::class, 'private_edit_course_form'])
                            ->name('edit-form');
                        Route::post('/{course}/edit', [CourseController::class, 'private_edit_course'])
                            ->name('edit');

                        // Delete course route
                        Route::get('/{course}/delete', [CourseController::class, 'private_delete_course'])
                            ->middleware('role:'.UserRole::ADMIN->value)
                            ->name('delete');

                        // Finish course route
                        Route::get('/{course}/finish', [CourseController::class, 'private_finish_course'])
                            ->name('finish');

                        // Add materials to course form route
                        Route::get('/{course}/add-material', [CourseController::class, 'private_add_material_course_form'])
                            ->name('add-material-form');
                        Route::post('/{course}/add-material', [CourseController::class, 'private_add_material_course'])
                            ->name('add-material');
                    });

                // Registrations routes
                Route::prefix('registration')
                    ->name('registrations.')
                    ->group(function () {
                        // Index registration route
                        Route::get('/', [RegistrationController::class, 'private_registrations'])
                            ->name('index');

                        Route::get('/search', [RegistrationController::class, 'private_registrations_search'])
                            ->name('search');

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
                            ->name('create-form');
                        Route::post('/', [EvaluationController::class, 'private_create_evaluation'])
                            ->name('create');
                    });

                //  Users routes
                Route::prefix('/users')
                    ->name('users.')
                    ->middleware('role:'.UserRole::ADMIN->value)
                    ->group(function () {
                        // Users index route
                        Route::get('/', [UserController::class, 'private_users'])
                            ->name('index');

                        // Modify user role routes
                        Route::get('/{user}/student', [UserController::class, 'private_student_role'])
                            ->name('student');
                        Route::get('/{user}/teacher', [UserController::class, 'private_teacher_role'])
                            ->name('teacher');
                        Route::get('/{user}/admin', [UserController::class, 'private_admin_role'])
                            ->name('admin');

                        // Delete user route
                        Route::get('/{user}/delete', [UserController::class, 'private_delete_user'])
                            ->name('delete');
                    });
            });
    });
});
