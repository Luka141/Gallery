<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Video::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'file_path' => 'videos/test-' . $this->faker->uuid . '.mp4',
            'thumbnail_path' => 'thumbnails/test-' . $this->faker->uuid . '.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
