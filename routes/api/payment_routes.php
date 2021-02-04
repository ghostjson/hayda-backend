<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function (){
    Route::post('checkout', [PaymentController::class, 'checkout']);
    Route::get('token', [PaymentController::class, 'stripeToken']);
    Route::get('balance', [PaymentController::class, 'getBalance']);
});

Route::post('status', [PaymentController::class, 'statusUpdate']);
