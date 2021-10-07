<?php
namespace App\PaymentGateway;



interface CreditCartPayment
{

    public function intent(array $attributes);
}
