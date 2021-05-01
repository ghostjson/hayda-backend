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
        $file = $request->file('file');
        $path =uniqid('', true). '.'. $file->getClientOriginalExtension();
        Storage::disk('s3')->put($path, file_get_contents($file), 'public');
        return 'https://hayda-web-app.s3.amazonaws.com/'.  $path;
    });
});
