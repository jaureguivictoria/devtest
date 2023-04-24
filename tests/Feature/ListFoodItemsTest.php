<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListFoodItemsTest extends TestCase
{

    public function test_can_list_empty_food_items(): void
    {
        $response = $this->getJson('/api/food_items');

        $response->assertJsonStructure([
            'data' => [],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ]
        ]);

        $response->assertJsonCount(0, 'data');

        $response->assertStatus(200);
    }
}
