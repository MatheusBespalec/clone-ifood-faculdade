<?php

namespace App\Livewire;

use App\Models\Restaurant;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantsList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.restaurants-list', [
            "restaurants" => Restaurant::cursorPaginate(9)
        ]);
    }
}
