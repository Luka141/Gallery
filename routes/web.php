<?php

use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\VideoController;
//use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Api\GalleryController;
use Illuminate\Support\Facades\Route;

 
    Route::get('/images', [ImageController::class, 'index']);
    Route::get('/images/{id}', [ImageController::class, 'show']);


    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/videos/{id}', [VideoController::class, 'show']);

    
    Route::get('/', [GalleryController::class, 'index']);
