<?php


namespace App\Usecase\Payment;


use App\Models\Order;

class CreateOrderFactory
{

    public function __construct(public $address)
    {
    }


    public function make()
    {
        $user = auth()->user();
        if(  request('payment_method') == 'stripe'  || (request('payment_method') == 'fpx' && request('redirect_status')  == 'succeeded') ){
            $orderAttributes = Order::$orderAttributes;
            request('payment_method') == 'fpx' ? $orderAttributes['payment_method'] = 'fpx' : '';

            $transactionAttributes = [
                'status' => request('redirect_status'),
                'payment_intent' => request('payment_intent'),
            ];

            $createOrderTransaction = CreateStripeOrderTransaction::class;
        }




        if(  request('payment_method') == 'paypal' ){
            $orderAttributes = Order::$orderAttributes;
            $orderAttributes['payment_method'] = 'wallet';
            $orderAttributes['payment_vendor'] = 'paypal';

            $transactionAttributes = [
                'status' => request('redirect_status'),
                'transaction_id' => request('transaction_id'),
                'paypal_order_id' => request('paypal_order_id'),
            ];

            $createOrderTransaction = CreatePaypalOrderTransaction::class;
        }


        $order = new CreateOrder($user,$this->address,$orderAttributes);
        return new $createOrderTransaction($order,$transactionAttributes);
    }
}
