<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')->group(function (){
    Route::post('', [PageController::class, 'create']);
    Route::delete('{page}', [PageController::class, 'destroy']);
    Route::post('{page}', [PageController::class, 'update']);

});

Route::get('', [PageController::class, 'index']);
Route::get('{page}', [PageController::class, 'show']);
