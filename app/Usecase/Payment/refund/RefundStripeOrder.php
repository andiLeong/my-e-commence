<?php
namespace App\Usecase\Payment\refund;


use App\Models\Order;
use App\PaymentGateway\CreditCartPayment;
use Illuminate\Support\Facades\DB;

class RefundStripeOrder implements RefundOrder
{

    protected $stripe;

    protected $status = [
        'succeeded' => 'refunded',
        'pending' => 'refund_pending',
        'failed' => 'refund_failed',
        'canceled' => 'refund_cancel',
    ];

    public function __construct()
    {
        $this->stripe = resolve(CreditCartPayment::class);
    }

    public function handle(Order $order) :string
    {
        $refundResult = $this->stripe->refund($order->stripeTransactions->payment_intent); //firing stripe api
        $status = $this->status[$refundResult->status];
        DB::transaction( fn() => $this->refund($order,$status,$refundResult->id) );  //update our database
        return $status;
    }

    public function refund($order,$status,$refundId)
    {
        $order->setRefunded($status);
        $order->stripeTransactions->setRefunded($refundId, $status);
    }
}
