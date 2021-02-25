<?php

use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function (Request $request) {
    return "HAYDA API";
});

Route::post('/search', [SearchController::class, 'search']);
