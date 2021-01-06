<?php

use App\Http\Controllers\GoalsController;
use Illuminate\Support\Facades\Route;

Route::post('/weight/add', [GoalsController::class, 'addWeight']);
Route::post('/weight/set', [GoalsController::class, 'setGoalWeight']);
Route::get('/weight', [GoalsController::class, 'getWeight']);
Route::delete('/weight/clear', [GoalsController::class, 'clearWeight']);
