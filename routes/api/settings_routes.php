<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')->group(function (){
    Route::get('', [SettingsController::class, 'getAllSettings']);
    Route::post('', [SettingsController::class, 'updateSettings']);
});

Route::get('/contact-email', [SettingsController::class, 'getContactEmail']);
Route::get('/app-urls', [SettingsController::class, 'getAppURLs']);
