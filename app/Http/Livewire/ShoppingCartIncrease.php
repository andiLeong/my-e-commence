<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartIncrement;
use Exception;
use Livewire\Component;

class ShoppingCartIncrease extends Component
{
    public Cart $cart;

    public function increase(ShoppingCartIncrement $shoppingCartIncrement)
    {
        try {
            $this->cart->adjustQuantity($shoppingCartIncrement);
            $this->emit('shoppingCartIncrease');
        }
        catch(Exception $e) {
            $this->dispatchBrowserEvent('notification', [
                'msg' => $e->getMessage(),
                'type' => 'danger'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.shopping-cart-increase');
    }
}
