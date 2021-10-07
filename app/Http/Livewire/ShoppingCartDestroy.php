<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class ShoppingCartDestroy extends Component
{
    public $cart_id ;

    public function destroy()
    {
        $cart = Cart::findOrFail($this->cart_id);
        $cart->removal()->remove();
        $this->emit('shoppingCartDelete');
    }

    public function render()
    {
        return view('livewire.shopping-cart-destroy');
    }
}
