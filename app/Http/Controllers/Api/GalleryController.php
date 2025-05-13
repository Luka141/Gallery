<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        
        $images = Image::orderBy('created_at', 'desc')->get();
        $videos = Video::orderBy('created_at', 'desc')->get();
        
        
        return view('gallery.index', compact('images', 'videos'));
    }
}