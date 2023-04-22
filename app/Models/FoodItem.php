<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @attribute string $name
 * @attribute float $measure
 * @attribute float $calories
 * @attribute float $carbs
 * @attribute float $protein
 * @attribute float $fat
 * @attribute float $fibre
 * @attribute FoodCategory $foodCategory
 */
class FoodItem extends Model
{
    use HasFactory;

    protected $attributes = [
        'name',
        'measure',
        'calories',
        'carbs',
        'protein',
        'fat',
        'fibre',
    ];

    public function foodCategory(): HasOne
    {
        return $this->hasOne(FoodCategory::class);
    }
}
