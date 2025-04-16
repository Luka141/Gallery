<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ImageResource;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Request $reques) 
    {
        $images = Image::orderBy('created_at', 'desc')->get();
        return ImageResource::collection($images);
    }


    public function show($id) 
    {
        $image = Image::findOrFail($id);

        return new ImageResource($image);
    }
}
