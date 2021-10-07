<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class TrendingProducts extends Component
{

    public $products;

    public function load()
    {
        sleep(2);
        $this->products = Product::take(4)->get();
    }

    public function render()
    {
        return view('livewire.trending-products');
    }
}
