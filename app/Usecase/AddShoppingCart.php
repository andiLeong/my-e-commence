<?php
namespace App\Usecase;


use App\Models\Cart;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartIncrement;

class AddShoppingCart
{
    public function handle($user,$attributes)
    {
        $cart = Cart::pickUpByUserWithProduct($user, $attributes['product_id']);
        if( !is_null($cart) ){
            $handler = new ShoppingCartIncrement();
            $cart->adjustQuantity($handler , $attributes['quantity']);
            return $cart;
        }
        return tap($user->carts()->create($attributes),
            fn($cart) => $cart->product->stockDecrease($attributes['quantity'])
        );
    }
}
