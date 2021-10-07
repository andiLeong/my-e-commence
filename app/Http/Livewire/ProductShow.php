<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    public $slug;

    protected $listeners = [
        'addedToShoppingCart' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.product-show',[
            'product' => Product::slug($this->slug)->onsale()->withShoppingCart(auth()->id())->firstOrFail(),
        ]);
    }
}
