<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    
    public function test_example(): void
    {
        Video::factory()->count(3)->create();
        
        $response = $this->get('/videos');
        
        $response->assertStatus(200);
    }
}