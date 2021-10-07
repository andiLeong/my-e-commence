<?php
namespace App\Usecase\ShoppingCartQuantityAdjustment;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class ShoppingCartDecrement implements ShoppingCartQuantityAdjustment
{

    public function handle(Cart $shoppingCart , $quantity = 1)
    {
        $over_quantity = $quantity >= $shoppingCart->quantity;
        if( $over_quantity ){
            return $shoppingCart->removal()->remove();
        }
        return $this->decrease($shoppingCart , $quantity);
    }

    protected function decrease($shoppingCart ,$quantity)
    {
        DB::transaction(function () use($shoppingCart , $quantity){
            $shoppingCart->decrement('quantity' , $quantity);
            $shoppingCart->product->stockIncrease($quantity);
        });
        return true;
    }

}
