<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Usecase\Payment\CreateOrderFactory;


class OrderSuccessController extends Controller
{
    public function store()
    {
        $address = Address::findOrFail(request('address_id'));
        //build up ab object
        $factory = (new CreateOrderFactory($address))->make();
        $factory->handle();

        // redirect to order page
        return redirect()->route('order.index');
    }
}
