<?php
namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Usecase\Payment\CreateStripeOrderTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PayWithStripe extends Component
{
    public $paymentIntentSecret;
    public $address_id;
    public $address;
    public $carts_total_price;
    public $carts;


    public function mount()
    {
        $this->address = Address::find($this->address_id);

    }

    public function createOrder($payment_id,$paymentIntent)
    {
        $para = "payment_method=stripe&address_id=$this->address_id&payment_intent=$payment_id&payment_intent_client_secret=$paymentIntent&redirect_status=succeeded";
        redirect()->route('order.success',$para);
    }

    public function render()
    {
        return view('livewire.pay-with-stripe');
    }
}
