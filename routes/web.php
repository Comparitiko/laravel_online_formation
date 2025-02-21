<?php

use App\Enums\UserRole;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Index route
Route::get('/', function () {
    Mail::to('gabigcy@gmail.com')->send(new RegisterMail());
});

Route::get('/prueba', function () {
    return 'hola';
})->middleware([
    'auth',
    'role:'.UserRole::STUDENT->value,
]);
//Route::get('/', [UserController::class, 'index'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
