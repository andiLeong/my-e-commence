<?php
namespace App\Usecase\Payment;


use Illuminate\Support\Facades\DB;

class CreatePaypalOrderTransaction
{

    public $order;
    public $transactionAttributes;

    /**
     * CreatePaypalOrderTransaction constructor.
     * @param $order
     * @param $transactionAttributes
     */
    public function __construct($order, $transactionAttributes)
    {
        $this->order = $order;
        $this->transactionAttributes = $transactionAttributes;
    }

    public function handle()
    {
        DB::transaction( fn() => $this->execute() );
        return true;
    }

    private function execute()
    {
        $order = $this->order->handle();
        $order->paypalTransactions()->create($this->transactionAttributes);
    }
}
