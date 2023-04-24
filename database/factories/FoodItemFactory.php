<?php

namespace Database\Factories;

use App\Models\FoodCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodItem>
 */
class FoodItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_category_id' => FoodCategory::factory(),
            'name' => fake()->randomElement([
                'Biscuit',
                'Chocolate',
                'Apple',
                'Wine',
                'Lettuce',
                'Tomato',
                'Milk',
                'Butter',
                'Rice',
                'Tea',
                'Bread',
                'Egg',
                'Cream',
            ]),
            'measure' => fake()->randomElement([
                '1',
                '125mL',
                '1 square',
                '1/2',
                ''
            ]),
            'calories' => fake()->randomNumber(5),
            'carbs' => fake()->randomFloat(1, 0, 10),
            'protein' => fake()->randomFloat(1, 0, 10),
            'fat' => fake()->randomFloat(1, 0, 10),
            'fibre' => fake()->randomFloat(1, 0, 10),
        ];
    }
}
