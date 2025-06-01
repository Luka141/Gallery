<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Video;
use App\Http\Resources\ImageResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->expectsJson()) {
            $images = Image::orderBy('created_at', 'desc')->get();
            return ImageResource::collection($images);
        }
        
        $images = Image::orderBy('created_at', 'desc')->get();
        $videos = Video::orderBy('created_at', 'desc')->get();
        
        $randomImages = Image::inRandomOrder()->limit(3)->get();
        $randomVideos = Video::inRandomOrder()->limit(3)->get();
        
        return view('gallery.index', compact('images', 'videos', 'randomImages', 'randomVideos'));
    }
    
    public function show($id)
    {
        $image = Image::findOrFail($id);     
        
        return view('gallery.show', compact('image'));
    }
    
    public function random(Request $request)
    {
        $randomImages = Image::inRandomOrder()->limit(3)->get();
        $randomVideos = Video::inRandomOrder()->limit(3)->get();
        
        return response()->json([
            'images' => ImageResource::collection($randomImages),
            'videos' => $randomVideos
        ]);
    }
}