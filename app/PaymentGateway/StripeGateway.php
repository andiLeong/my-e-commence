<?php
namespace App\PaymentGateway;


use Stripe\PaymentIntent;

class StripeGateway implements CreditCartPayment
{

    private $stripe;

    public function __construct($key)
    {
        \Stripe\Stripe::setApiKey($key);
        $this->stripe = new \Stripe\StripeClient($key);
    }

    public function intent(array $attributes)
    {
        return PaymentIntent::create(
            array_merge($attributes,[
                    'currency' => 'myr',
                    'metadata' => ['integration_check' => 'accept_a_payment'],
            ]));
    }

    public function retrieveIntent($intent)
    {
        return $this->stripe->paymentIntents->retrieve($intent, []);
    }


    public function refund($payment_id)
    {
        return $this->stripe->refunds->create([
            'payment_intent' => $payment_id,
        ]);
    }

    public function createCustomer($attributes)
    {
        return $this->stripe->customers->create($attributes);
    }


}
