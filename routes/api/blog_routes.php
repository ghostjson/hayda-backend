<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('', [BlogController::class, 'index']);
Route::post('', [BlogController::class, 'create']);
Route::get('{blog}', [BlogController::class, 'show']);
Route::delete('{blog}', [BlogController::class, 'destroy']);
Route::post('{blog}', [BlogController::class, 'update']);
