<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::post('/', [ChatController::class, 'run']);

Route::get('/intents', [ChatController::class, 'getIntents']);
Route::post('/intents', [ChatController::class, 'putIntents']);
