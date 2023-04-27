<?php

namespace App\Http\Livewire;

use App\Http\Resources\FoodItemCollection;
use App\Models\FoodItem;
use Livewire\Component;
use Livewire\WithPagination;

class SearchFoodItems extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $foodItems = new FoodItemCollection(FoodItem::where('name', 'like', '%'.$this->search.'%')->paginate());

        return view('livewire.search-food-items')->with('foodItems', $foodItems);
    }
}
