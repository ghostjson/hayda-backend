<?php

use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


Route::get('/', function (Request $request) {
    return "HAYDA API";
});

Route::post('/search', [SearchController::class, 'search']);

Route::middleware('admin.auth')->group(function () {
    Route::post('/file-upload', function (Request $request) {
        return URL::to('/') . Storage::url($request->file('file')->store('public'));
    });
});
