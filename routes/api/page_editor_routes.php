<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('', [PageController::class, 'index']);
Route::post('', [PageController::class, 'create']);
Route::get('{page}', [PageController::class, 'show']);
Route::delete('{page}', [PageController::class, 'destroy']);
Route::post('{page}', [PageController::class, 'update']);
