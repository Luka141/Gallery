<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request) 
    {
        $videos = Video::orderBy('created_at', 'desc')->get();

        return VideoResource::collection($videos);
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        
        return new VideoResource($video);
    }

}
