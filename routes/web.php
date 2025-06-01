<?php

use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\VideoController;
//use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\GalleryVideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\GalleryMediaController;

 
    Route::get('/images', [ImageController::class, 'index']);
    Route::get('/images/{id}', [ImageController::class, 'show']);


    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/videos/{id}', [VideoController::class, 'show']);

    
    Route::get('/', [GalleryController::class, 'index']);
    
    Route::get('/gallery', [GalleryImageController::class, 'index']);
    Route::get('/gallery/{id}', [GalleryImageController::class, 'show'])->name('gallery.show');

    Route::get('/video', [GalleryVideoController::class, 'index']);
    Route::get('/video/{id}', [GalleryVideoController::class, 'show'])->name('video.show');


    
    Route::get('/gallery/image/{id}', [GalleryImageController::class, 'show'])->name('gallery.image.show');
    Route::get('/gallery/video/{id}', [GalleryVideoController::class, 'show'])->name('gallery.video.show');
    
    Route::get('video/{id}', [GalleryController::class, 'showVideo'])->name('video.show');
    Route::get('/gallery', [GalleryImageController::class, 'index'])->name('gallery.index');



