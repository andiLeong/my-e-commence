<?php
namespace App\Models;


class ShoppingCartRemoval
{

    /**
     * ShoppingCartRemoval constructor.
     * @param Cart $cart
     */
    public function __construct( protected Cart $cart)
    {

    }

    public function remove()
    {
        return tap( $this->cart->delete() , fn($res) => $this->cart->product->stockIncrease( $this->cart->quantity ) );
    }

    public function removeAll($user)
    {
        $user->carts->each(fn($item) => $item->removal()->remove() );
        return true;
    }

    public function removeFrom(int $intervals = 1)
    {
        $days = now()->subDays($intervals);
        return $this->cart->createdLessThan($days)->delete();
    }

}
