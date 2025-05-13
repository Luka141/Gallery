<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Resources\ImageResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{


    public function index(Request $request) 
    {
        $images = Image::orderBy('created_at', 'desc')->get();
        
        return ImageResource::collection($images);
    }
    public function show($id)
    {
        $image = Image::findOrFail($id);     
        
        return view('gallery.show', compact('image'));
    }
}