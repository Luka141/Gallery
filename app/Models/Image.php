<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

   
    public function fullImgFileUrl() 
    {
        return asset('storage/' . $this->file_path);
    }

    
}
