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
        // return Storage::url($this->file_path);
    }

    public function getThumbnailFullUrl()
    {
        // if ($this->thumbnail_path) {
        //     return Storage::url($this->thumbnail_path);
        // } else {
        //     return null;
        // }
        return asset('storage/' . $this->thumbnail_path);
    }
}
