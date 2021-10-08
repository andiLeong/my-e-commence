<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class AddToCart extends Component
{

    public $product_id;
    public $level;

    public function addToCart($product_id)
    {
        if( !auth()->check()){
            return $this->dispatchBrowserEvent('notification', ['msg' => 'Please Login First!' , 'type' => 'danger']);
        }
        Product::findOrFail($product_id);
        (new Cart)->addBy(auth()->user(),['quantity' => 1 , 'product_id' => $product_id]);
        $refresh;
        $this->emit('addedToShoppingCart');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
