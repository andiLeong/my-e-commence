<?php
namespace App\Usecase\Payment\init;


use Illuminate\Support\Str;

abstract class InitializePayment
{

    public function getViewDefaultData()
    {
        return [
            'address_id' => $this->address_id,
            'carts_total_price' => $this->carts->sum('total'),
            'carts' => $this->carts,
        ];
    }

    public function getViewName()
    {
        return "home.payment.{$this->getVendorViewName()}";
    }

    public function getVendorViewName()
    {
        return Str::of(class_basename($this))
            ->replace('Initialize', '')
            ->replace('Payment', '')
            ->lower();
    }

}
