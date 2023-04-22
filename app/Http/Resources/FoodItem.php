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
            'calories' => $this->name,
            'measure' => $this->name,
            'fat' => $this->name,
            'protein' => $this->name,
            'carbs' => $this->name,
            'fibre' => $this->name,
        ];
    }
}
