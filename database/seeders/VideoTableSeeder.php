<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::truncate();

        $videos = [
        [
            'title' => 'Laravel Tutorial',
            'description' => 'Laravel description',
            'file_path' => 'videos/laravel_intro.mp4',
            'thumbnail_path' => 'thumbnails/laravel_thumb.jpg',
        ],

        [
            'title' => 'Filament Tutorial',
            'description' => 'Filament DEscription Where you Can Write',
            'file_path' => 'videos/filament_overview.mp4',
            'thumbnail_path' => 'thumbnails/filament_thumb.jpg',
        ],

        [
            'title' => 'TuTorial 3',
            'description' => 'Description',
            'file_path' => 'videos/blade_templates.mp4',
            'thumbnail_path' => 'thumbnails/blade_thumb.jpg',
        ]
    ];

    foreach ($videos as $video) {
        Video::create($video);
    }
  }
}
