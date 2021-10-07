<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Usecase\Payment\refund\RefundPaypalOrder;
use App\Usecase\Payment\refund\RefundStripeOrder;
use Exception;
use Livewire\Component;

class Refund extends Component
{

    public $orderId;


    public function refund($order_id)
    {
        $order = Order::findOrFail($order_id);
        $refundStrategy = match ($order->payment_vendor) {
            'stripe' => RefundStripeOrder::class,
            'paypal' => RefundPaypalOrder::class,
            default => throw new exception('vendor not exist!'),
        };
        $refundStatus = (new $refundStrategy())->handle($order);
        $this->dispatchBrowserEvent('notification', ['msg' => "Order is $refundStatus now !"]);
        $this->emit('orderIsRefunded');
    }

    public function render()
    {
        return view('livewire.refund');
    }
}

