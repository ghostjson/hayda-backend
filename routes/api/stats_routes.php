<?php

use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin.auth'])->group(function () {
    Route::get('', [StatsController::class, 'getStats']);
    Route::get('users', [StatsController::class, 'getUsersStats']);
});
