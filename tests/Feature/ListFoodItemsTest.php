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

    public function test_can_list_food_items(): void
    {
        $this->seed();

        $response = $this->getJson('/api/food_items');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [[
                'id',
                'name',
                'calories',
                'measure',
                'fat',
                'protein',
                'carbs',
                'fibre'
            ]],
        ]);

        $defaultItemsPagination = 15;

        $response->assertJsonCount($defaultItemsPagination, 'data');

    }

    public function test_can_list_food_items_paginated()
    {
        $this->seed();

        $response = $this->getJson('/api/food_items?page=2&per_page=20');

        $response->assertStatus(200);

        $response->assertJsonFragment(['current_page' => 2]);

        $response->assertJsonFragment(['per_page' => 20]);
    }
}
