<?php


namespace App\Usecase\Payment\refund;


use App\Models\Order;
use Exception;

interface RefundOrder
{
    public function handle(Order $order) :string|Exception ;

}
