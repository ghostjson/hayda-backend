<?php


use App\Http\Controllers\ContentEditor;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin.auth'])->group(function () {
    Route::get('/', [ContentEditor::class, 'index']);
    Route::post('{name}', [ContentEditor::class, 'putPage']);
});
Route::get('{page}', [ContentEditor::class, 'getPage']);
