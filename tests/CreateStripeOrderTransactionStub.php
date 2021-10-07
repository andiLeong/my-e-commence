<?php
namespace Tests;


use App\Models\StripeOrderTransaction;
use App\PaymentGateway\CreditCartPayment;
use Exception;

class CreateStripeOrderTransactionStub
{

    public $stripe;
    public $order;
    public $transactionAttributes;

    public function __construct($order,$transactionAttributes)
    {
        $this->stripe = resolve(CreditCartPayment::class);
        $this->order = $order;
        $this->transactionAttributes = $transactionAttributes;
    }

    public function handle()
    {
        $order = $this->order->handle();
        $this->validatePaymentIntent($this->transactionAttributes);
        $order->stripeTransactions()->create($this->transactionAttributes);
        return true;
    }


    public function validatePaymentIntent($intent)
    {

        if( StripeOrderTransaction::where('payment_intent' , $intent)->exists() ){
            throw new Exception('Payment Already Exists');
        }
        logger('firing to check stripe payment intent');
    }
}
