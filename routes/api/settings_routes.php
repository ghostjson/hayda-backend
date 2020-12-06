<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;


Route::get('', [SettingsController::class, 'getAllSettings']);
Route::post('', [SettingsController::class, 'updateSettings']);
