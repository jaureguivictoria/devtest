<?php

namespace App\Http\Livewire;

use App\Http\Resources\FoodItemCollection;
use App\Models\FoodItem;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchFoodItems extends Component
{
    public $search;

    public function render()
    {
        $foodItems = new FoodItemCollection(FoodItem::where('name', 'like', '%'.$this->search.'%')->paginate());

        Log::debug(json_encode($foodItems));

        return view('livewire.search-food-items')->with('foodItems', $foodItems);
    }
}
