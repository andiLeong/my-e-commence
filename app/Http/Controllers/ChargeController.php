<?php

namespace App\Http\Controllers;

use App\Usecase\Payment\init\InitializeFpxPayment;
use App\Usecase\Payment\init\InitializePaypalPayment;
use App\Usecase\Payment\init\InitializeStripePayment;
use Exception;
use Illuminate\Validation\Rule;

class ChargeController extends Controller
{

    public function store()
    {
        $data = request()->validate([
            'address_id' => ['required','integer',
                Rule::exists('addresses','id')->where( fn($query) => $query->where('user_id', auth()->id())),
            ],
            'payment_method' => 'required|in:alipay,paypal,credit_card,fpx',
        ]);

        $carts = auth()->user()->carts()->with('product','product.category')->get();

        $iniPaymentStrategy = match ($data['payment_method']) {
            'credit_card' => InitializeStripePayment::class,
            'paypal' => InitializePaypalPayment::class,
            'fpx' => InitializeFpxPayment::class,
            default => throw new exception('vendor not exist!'),
        };

        return (new $iniPaymentStrategy($data['address_id'],$carts))->handle();
    }
}
