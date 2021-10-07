<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartDecrement;
use Livewire\Component;

class ShoppingCartDecrease extends Component
{

    public Cart $cart;

    public function decrease(ShoppingCartDecrement $cartDecrement)
    {
        $this->cart->adjustQuantity($cartDecrement);
        $this->emit('shoppingCartDecrease');
    }

    public function render()
    {
        return view('livewire.shopping-cart-decrease');
    }
}
