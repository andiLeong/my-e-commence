<?php
namespace App\Usecase\ShoppingCartQuantityAdjustment;


use App\Models\Cart;

interface ShoppingCartQuantityAdjustment
{
    public function handle(Cart $shoppingCart , $quantity = 1);
}
