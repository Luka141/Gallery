<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
    ];

    public function fullImgFileUrl() 
    {
        return asset('storage/' . $this->file_path);
    }
}
