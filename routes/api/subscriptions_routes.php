<?php


use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'admin.auth'])->group(function () {
    Route::post('', [SubscriptionController::class, 'store']);
});

Route::middleware(['auth'])->group(function (){
    Route::get('/', [SubscriptionController::class, 'index']);
});
