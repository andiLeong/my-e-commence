<?php
namespace App\Http\Livewire;

use App\Models\Address;
use Livewire\Component;

class CheckoutIndex extends Component
{

    public $address;
    public $address_id;
    public $payment_method = 'credit_card';


    public function render()
    {
        $carts = auth()->user()->carts()->with('product','product.category')->get();
        return view('livewire.checkout-index',[
            'carts' => $carts,
            'carts_total_price' => $carts->sum('total') ,
            'has_address' => Address::where('user_id',auth()->id())->exists() ,
        ]);
    }
}
