<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/chat-bot', [ChatController::class, 'run']);
