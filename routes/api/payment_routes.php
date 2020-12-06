<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('balance', [PaymentController::class, 'getBalance']);
