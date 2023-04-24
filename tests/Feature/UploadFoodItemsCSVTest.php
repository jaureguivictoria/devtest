<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class UploadFoodItemsCSVTest extends TestCase
{
    public function test_upload_food_requires_a_file(): void
    {
        $response = $this->postJson('/api/food_items/upload');

        $response->assertStatus(422);

        $response->assertJsonValidationErrorFor('file');

        $response->assertJsonValidationErrors(['file' => 'required']);
    }
}
