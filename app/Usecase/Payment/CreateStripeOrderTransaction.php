<?php
namespace App\Usecase\Payment;


use App\Models\StripeOrderTransaction;
use App\PaymentGateway\CreditCartPayment;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateStripeOrderTransaction
{

    public $stripe;
    public $order;
    public $transactionAttributes;

    /**
     * CreateStripeOrderTransaction constructor.
     * @param $order
     * @param $transactionAttributes
     */
    public function __construct(CreateOrder $order, array $transactionAttributes)
    {
        $this->stripe = resolve(CreditCartPayment::class);
        $this->order = $order;
        $this->transactionAttributes = $transactionAttributes;
    }

    public function handle()
    {
        DB::transaction( fn() => $this->execute() );
        return true;
    }

    public function execute()
    {
        $order = $this->order->handle();
        $this->validatePaymentIntent($this->transactionAttributes['payment_intent']);
        $order->stripeTransactions()->create($this->transactionAttributes);
    }


    public function validatePaymentIntent($intent)
    {

        if( StripeOrderTransaction::where('payment_intent' , $intent)->exists() ){
            throw new Exception('Payment Already Exists');
        }

        logger('firing to check stripe payment intent');

        $intent = $this->stripe->retrieveIntent($intent);
        if( $intent->status != 'succeeded'){
            throw new Exception("$intent Payment Invalid or Fails");
        }

    }
}
