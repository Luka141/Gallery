<?php

namespace App\Http\Controllers;
use App\Http\Resources\VideoResource;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class GalleryVideoController extends Controller
{


    public function index(Request $request) 
    {
        $videos = Video::orderBy('created_at', 'desc')->get();
        
        return VideoResource::collection($videos);
    }
    public function show($id)
    {
        $video = Video::findOrFail($id);     
        
        return view('gallery.show', compact('video'));
    }
}