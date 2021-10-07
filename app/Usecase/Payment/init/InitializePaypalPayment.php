<?php


namespace App\Usecase\Payment\init;


class InitializePaypalPayment extends InitializePayment
{

    public function __construct(
        public $address_id,
        public $carts,
    )
    {

    }

    public function handle()
    {
        return view($this->getViewName(), $this->getViewDefaultData());
    }
}
