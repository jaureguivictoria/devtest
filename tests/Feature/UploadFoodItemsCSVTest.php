<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use League\Csv\Writer;
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

    public function test_cannot_upload_empty_food_items(): void
    {
        $file = UploadedFile::fake()->create('items.csv', 100, 'text/csv');

        $response = $this->postJson('/api/food_items/upload', ['file' => $file]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrorFor('file');
    }

    public function test_can_upload_food_items(): void
    {
        $foodItemColumns = ['name', 'measure', 'calories', 'protein', 'fat', 'carbs', 'fibre'];

        $header = Arr::prepend($foodItemColumns, 'Category');

        $foodCategory1 = 'Baked Goods';
        $foodCategory2 = 'Dairy';

        $foodItem1 = ['Angelfood, commercial (25cm diam)','1/12','73','2','16','0.4','60'];
        $foodItem2 = ['Milk','1 Lt','100','5','89','64.5','57'];

        $records = [
            Arr::prepend($foodItem1, $foodCategory1),
            Arr::prepend($foodItem2, $foodCategory2),
        ];

        $csv = Writer::createFromString();

        $csv->insertOne($header);

        $csv->insertAll($records);

        $file = UploadedFile::fake()->createWithContent('items.csv', $csv->toString());

        $response = $this->postJson('/api/food_items/upload', ['file' => $file]);

        $response->assertOk();

        $this->assertDatabaseCount('food_categories', 2);

        $this->assertDatabaseHas('food_categories', ['name' => $foodCategory1]);

        $this->assertDatabaseHas('food_categories', ['name' => $foodCategory2]);

        $this->assertDatabaseCount('food_items', 2);

        $this->assertDatabaseHas('food_items', array_combine($foodItemColumns, $foodItem1));

        $this->assertDatabaseHas('food_items', array_combine($foodItemColumns, $foodItem2));
    }
}
