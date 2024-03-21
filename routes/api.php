<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TempImageController;


Route::post('blogs', [BlogController::class,'store']);
Route::get('showBlog', [BlogController::class,'show']);
Route::post('save-temp-image', [TempImageController::class,'store']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
