<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('is_exist', [AuthController::class, 'isEmailExist'])->name('auth.email.exist');

Route::post('register', [AuthController::class, 'register'])->name('auth.register');

Route::middleware('auth')->group(function (){
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('user/update', [AuthController::class, 'updateProfile'])->name('auth.profile.update');
});

