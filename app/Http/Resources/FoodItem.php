<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class FoodItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'calories' => $this->calories.' kcal',
            'measure' => $this->measure,
            'fat' => $this->fat,
            'protein' => $this->protein,
            'carbs' => $this->carbs,
            'fibre' => $this->fibre,
        ];
    }
}
