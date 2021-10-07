<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class ShoppingCartIndex extends Component
{


    protected $listeners = [
        'shoppingCartDelete' => '$refresh',
        'shoppingCartIncrease' => '$refresh',
        'shoppingCartDecrease' => '$refresh',
    ];

//    public function mount()
//    {
//        $this->cart = auth()->user()->carts()->with('product')->get();
//        $this->carts_total_price = auth()->user()->cartsTotalPrice();
//    }

    public function destroyAll()
    {
        (new cart)->removal()->removeAll(auth()->user());
        $this->emit('shoppingCartDelete');
    }

    public function checkout()
    {
        redirect()->route('checkout.index');
    }

    public function render()
    {
        $carts = auth()->user()->carts()->with('product')->get();
        return view('livewire.shopping-cart-index',[
            'carts' => $carts,
            'carts_total_price' => $carts->sum('total') ,
        ]);
    }
}
