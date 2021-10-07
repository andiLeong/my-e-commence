<?php
namespace App\Usecase\Payment;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;

 class CreateOrder
{

    public $orderTotalPrice;
    public $order;
    public $cartsCollection;

     public function __construct(
        public User $user,
        public Address $address,
        public array $orderAttributes,
    )
    {
        $this->cartsCollection = $this->user->carts;
    }

    public function handle()
    {
        //1 create order
        //2 create order address
        //3 clear out shopping cart
        //4 record associated order product
        //5 update order total price

        $this->make()
            ->recordOrderProducts()
            ->clearCartItems()
            ->updateOrderPrice();
        return $this->order;
    }


     public function make()
     {
         $this->order = tap($this->user->orders()->create($this->orderAttributes) , fn($order) =>
            $this->address->replicate()->fill(['order_id' => $order->id,])->save()
         );
         return $this;
     }

     public function recordOrderProducts()
     {
         $orderProduct = New OrderProduct();
         $orderProduct->parseCartDataToArray($this->cartsCollection,$this->order)->insertFromCart();

         $this->orderTotalPrice = collect($orderProduct->cartData)->sum('total_price');
         return $this;
    }

     public function clearCartItems()
     {
         $ids = $this->cartsCollection->pluck('id');
         Cart::clearItem($ids);
         return $this;
     }


     public function updateOrderPrice()
     {
         $this->order->updateTotalPrice($this->orderTotalPrice);
         return $this;
     }

}
