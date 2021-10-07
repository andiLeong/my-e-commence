<?php

namespace App\Usecase;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Usecase\AddShoppingCart
 */
class CartAdd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Usecase\AddShoppingCart';
    }
}
