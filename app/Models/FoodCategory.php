<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
*/
class FoodCategory extends Model
{
    use HasFactory;

    protected $attributes = [
        'name'
    ];
}
