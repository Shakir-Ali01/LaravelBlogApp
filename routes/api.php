<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;


Route::post('blogs', [BlogController::class,'store']);
Route::get('showBlog', [BlogController::class,'show']);
// Route::get('showBlog', [BlogController::class,'show']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
