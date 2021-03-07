<?php

use App\Http\Controllers\PodcastController;
use Illuminate\Support\Facades\Route;

Route::get('', [PodcastController::class, 'index']);


Route::middleware('admin.auth')->group(function(){
    Route::post('',[PodcastController::class, 'addLink']);

    Route::delete('{podcast}',[PodcastController::class, 'removeLink']);
});
