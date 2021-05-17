<?php

use App\Http\Controllers\HealthHubController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','admin.auth'])->group(function (){
    Route::post('/',[ HealthHubController::class, 'create']);
    Route::post('/{healthHub}',[ HealthHubController::class, 'update']);
    Route::delete('/{healthHub}',[ HealthHubController::class, 'destroy']);

    Route::get('/category/increase/{category}', [HealthHubController::class, 'increaseCategoryPriority']);
    Route::get('/link/increase/{healthHub}', [HealthHubController::class, 'increaseLinkPriority']);
    Route::get('category/decrease/{category}', [HealthHubController::class, 'decreaseCategoryPriority']);
    Route::get('/link/decrease/{healthHub}', [HealthHubController::class, 'decreaseLinkPriority']);
});

Route::get('/',[ HealthHubController::class, 'index']);
Route::get('/{healthHub}',[ HealthHubController::class, 'show']);
