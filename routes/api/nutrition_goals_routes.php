<?php

use App\Http\Controllers\NutritionGoalsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){

    Route::get('', [NutritionGoalsController::class, 'index']);
    Route::post('', [NutritionGoalsController::class, 'create']);
    Route::get('{blog}', [NutritionGoalsController::class, 'show']);
    Route::delete('{blog}', [NutritionGoalsController::class, 'destroy']);
    Route::post('{blog}', [NutritionGoalsController::class, 'update']);
});

