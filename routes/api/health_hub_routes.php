<?php

use App\Http\Controllers\HealthHubController;
use Illuminate\Support\Facades\Route;


Route::get('/',[ HealthHubController::class, 'index']);
Route::post('/',[ HealthHubController::class, 'create']);
Route::get('/{healthHub}',[ HealthHubController::class, 'show']);
Route::post('/{healthHub}',[ HealthHubController::class, 'update']);
Route::delete('/{healthHub}',[ HealthHubController::class, 'destroy']);
