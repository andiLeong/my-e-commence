<?php
namespace App\Usecase\ShoppingCartQuantityAdjustment;

use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\DB;

class ShoppingCartIncrement implements ShoppingCartQuantityAdjustment
{

    public function handle(Cart $cart ,$quantity = 1)
    {
        return !$this->increaseQuantityOverStocks($cart , $quantity)
            ? $this->increase($cart , $quantity)
            : throw new exception('product is running out of stocks');
    }

    protected function increaseQuantityOverStocks($cart , $quantity): bool
    {
        return $quantity > $cart->product->stocks;
    }

    protected function increase($cart , $quantity): bool
    {
        DB::transaction(function () use($cart ,$quantity){
            $cart->increment('quantity' , $quantity);
            $cart->product->stockDecrease( $quantity);
        });
        return true;
    }
}
