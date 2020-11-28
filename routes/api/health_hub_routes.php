<?php

use App\Http\Controllers\HealthHubController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','admin.auth'])->group(function (){
    Route::post('/',[ HealthHubController::class, 'create']);
    Route::post('/{healthHub}',[ HealthHubController::class, 'update']);
    Route::delete('/{healthHub}',[ HealthHubController::class, 'destroy']);
});

Route::get('/',[ HealthHubController::class, 'index']);
Route::get('/{healthHub}',[ HealthHubController::class, 'show']);
