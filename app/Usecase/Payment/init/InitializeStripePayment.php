<?php


namespace App\Usecase\Payment\init;


use App\PaymentGateway\CreditCartPayment;

class InitializeStripePayment extends InitializePayment
{

    protected $stripe;

    public function __construct(
        public $address_id,
        public $carts,
    )
    {
        $this->stripe = resolve(CreditCartPayment::class);
    }

    public function handle()
    {
        $intent = $this->stripe->intent(['amount' => $this->carts->sum('total') * 100 ]);
        return view($this->getViewName(),
            array_merge($this->getViewDefaultData(), [
                'paymentIntentSecret' => $intent->client_secret,
            ])
        );
    }

}
