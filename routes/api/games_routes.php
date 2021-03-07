<?php

use App\Http\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

Route::get('', [GamesController::class, 'index']);

Route::middleware('admin.auth')->group(function(){
    Route::post('',[GamesController::class, 'addLink']);

    Route::delete('{game}',[GamesController::class, 'removeLink']);
});
