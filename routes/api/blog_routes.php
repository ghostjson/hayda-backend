<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')->group(function (){
    Route::post('', [BlogController::class, 'create']);
    Route::delete('{blog}', [BlogController::class, 'destroy']);
    Route::post('{blog}', [BlogController::class, 'update']);

});

Route::get('', [BlogController::class, 'index']);
Route::get('recent', [BlogController::class, 'getRecent3Blogs']);
Route::get('categories', [BlogController::class, 'getBlogCategories']);
Route::get('categories/{category}', [BlogController::class, 'getBlogsByCategory']);
Route::get('{blog}', [BlogController::class, 'show']);

