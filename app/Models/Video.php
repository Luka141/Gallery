<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'thumbnail_path',
    ];

    public function getVideoFullUrl()
    {
        return asset('storage/' . $this->file_path);
       
    }

    public function getThumbnailFullUrl()
    {
       
        return asset('storage/' . $this->thumbnail_path);
    }
}
