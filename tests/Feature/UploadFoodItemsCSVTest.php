<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
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

    public function test_upload_food_requires_a_csv_type_of_file(): void
    {
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->postJson('/api/food_items/upload', ['file' => $file]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrorFor('file');

        $response->assertJsonValidationErrors(['file' => 'type']);
    }

    public function test_upload_food_validates_file_size(): void
    {
        $file = UploadedFile::fake()->create('items.csv', 10001, 'text/csv');

        $response = $this->postJson('/api/food_items/upload', ['file' => $file]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrorFor('file');
    }
}
