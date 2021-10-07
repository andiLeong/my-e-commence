<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartDecrement;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\GetCartAttributes;
use Tests\TestCase;

class CartDecrementTest extends TestCase
{
    use RefreshDatabase;
    use GetCartAttributes;

    protected $user;
    protected $product;
    protected $quantity = 1;
    protected $attributes;
    protected ShoppingCartDecrement $handler;

    public function setUp() :void
    {
        parent::setUp();
        $this->handler = new ShoppingCartDecrement();
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create([
            'stocks' => 100
        ]);

        $total = $this->product->price * $this->quantity ;
        $this->attributes = $this->getAddToCartAttributes($this->product,quantity : $this->quantity) ;
    }

    /** @test */
    public function a_shopping_cart_can_decrease()
    {
        $this->attributes['quantity'] = 5;
        $cart = (new Cart)->addBy($this->user,$this->attributes);

        $cart->adjustQuantity($this->handler, 2);
        $this->assertEquals(3, $cart->refresh()->quantity );
    }

    /** @test */
    public function a_shopping_cart_will_be_deleted_if_decrease_to_zero_quantity()
    {
        $this->attributes['quantity']  = 5;
        $cart = (new Cart)->addBy($this->user,$this->attributes);

        $cart->adjustQuantity($this->handler, 6);
        $this->assertEquals(0, Cart::all()->count());
    }

    /** @test */
    public function once_a_shopping_cart_decreased_product_stock_will_increase()
    {

        $product2 = Product::factory()->create(['stocks' => 100]);
        $cart2 = (new Cart)->addBy($this->user,
            $this->getAddToCartAttributes($product2,quantity : 10)
        );

        $cart2->adjustQuantity($this->handler, 2); // cart has 10 - 2 = 8
        $this->assertEquals(92, $cart2->refresh()->product->stocks );

        $cart2->adjustQuantity($this->handler, 10000);
        $this->assertEquals( 100, $cart2->refresh()->product->stocks );
        $this->assertEquals(0, Cart::all()->count());
    }

}
