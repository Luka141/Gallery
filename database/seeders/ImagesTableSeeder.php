<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImagesTableSeeder  extends Seeder
{
    public function run()
    {
        
        Image::truncate();
        
        
        $images = [
            [
                'title' => 'First photo',
                'description' => 'First photo description',
                'file_path' => 'images/default1.jpg',
            ],
            [
                'title' => 'Second photo',
                'description' => 'Second photo description',
                'file_path' => 'images/default2.jpg',
            ],
            [
                'title' => 'Third photo',
                'description' => 'Third photo description',
                'file_path' => 'images/default3.jpg',
            ],
            
        ];
        
       
        foreach ($images as $image) {
            Image::create($image);
        }     
    }
}