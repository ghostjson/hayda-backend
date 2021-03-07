<?php


use App\Http\Controllers\GoalsController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::post('/weight/add', [GoalsController::class, 'addWeight']);
    Route::post('/weight/set', [GoalsController::class, 'setGoalWeight']);
    Route::get('/weight', [GoalsController::class, 'getWeight']);
    Route::delete('/weight/clear', [GoalsController::class, 'clearWeight']);

    Route::post('/workout/add', [WorkoutController::class, 'add']);
    Route::post('/workout/set', [WorkoutController::class, 'setGoal']);
    Route::get('/workout', [WorkoutController::class, 'get']);
    Route::delete('/workout/clear', [WorkoutController::class, 'reset']);
});



