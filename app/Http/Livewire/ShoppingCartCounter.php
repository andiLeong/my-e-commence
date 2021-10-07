<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShoppingCartCounter extends Component
{

    protected $listeners = [
        'shoppingCartDelete' => '$refresh',
        'shoppingCartDecrease' => '$refresh',
        'addedToShoppingCart' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.shopping-cart-counter',[
            'counter' => auth()->check() ? auth()->user()->carts->count() : 0,
        ]);
    }
}
