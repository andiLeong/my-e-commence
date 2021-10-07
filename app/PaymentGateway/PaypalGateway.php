<?php
namespace App\PaymentGateway;


use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Payments\CapturesRefundRequest;
use Sample\PayPalClient;

class PaypalGateway
{

    public $httpClient;
    public static $successHttpResponseCode = ['200' , '201' ,'203' , '204'];

    public function __construct(public array $keys ,  )
    {
        $this->httpClient = new PayPalHttpClient($this->setEnv());
    }

    public function setEnv()
    {
        return new SandboxEnvironment($this->keys['client_id'],$this->keys['client_secret'],);
    }


    public function retrieveOrder($orderId)
    {
        return $this->httpClient->execute(new OrdersGetRequest( $orderId));
    }

    public function refund($transactionId)
    {
        $request = new CapturesRefundRequest($transactionId);
        $request->body = '';
        return $this->httpClient->execute($request);
    }
}
