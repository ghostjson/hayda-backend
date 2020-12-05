<?php


use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SubscriptionController::class, 'index']);
Route::post('', [SubscriptionController::class, 'store']);
