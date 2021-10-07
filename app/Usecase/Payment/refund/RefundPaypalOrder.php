<?php
namespace App\Usecase\Payment\refund;


use App\Models\Order;
use App\PaymentGateway\PaypalGateway;
use Exception;
use Illuminate\Support\Facades\DB;


class RefundPaypalOrder implements RefundOrder
{

    protected $status = [
        'completed' => 'refunded',
    ];

    protected $paypal;

    public function __construct()
    {
        $this->paypal = resolve(PaypalGateway::class);
    }

    public function handle(Order $order): string
    {
        $transactionId = $order->paypalTransactions->transaction_id;
        $refundResult =  $this->paypal->refund($transactionId);
        if(   in_array($refundResult->statusCode, PaypalGateway::$successHttpResponseCode   ) ){
            $status = $this->status[strtolower($refundResult->result->status)];
            DB::transaction( fn() => $this->refund($order,$status) );  //update our database
            return $status;
        }
        return throw new Exception('paypal refund api return status code of ' . $refundResult->statusCode);
    }

    public function refund($order,$status)
    {
        $order->setRefunded($status);
        $order->paypalTransactions->setRefunded($status);
    }
}
