<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartIncrement;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\GetCartAttributes;
use Tests\TestCase;

class CartIncrementTest extends TestCase
{
    use RefreshDatabase;
    use GetCartAttributes;

    protected $user;
    protected $product;
    protected $quantity = 1;
    protected $attributes;
    protected ShoppingCartIncrement $handler;

    public function setUp() :void
    {
        parent::setUp();
        $this->handler = new ShoppingCartIncrement();
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create([
            'stocks' => 100
        ]);

        $total = $this->product->price * $this->quantity ;
        $this->attributes = $this->getAddToCartAttributes($this->product,quantity : $this->quantity) ;
    }

    /** @test */
    public function a_shopping_cart_item_can_increase()
    {
        $cart = (new Cart)->addBy($this->user,$this->attributes);

        $cart->adjustQuantity($this->handler, 2);
        $this->assertEquals(3, $cart->fresh()->quantity );

        $cart->adjustQuantity($this->handler);
        $this->assertEquals(4, $cart->fresh()->quantity );
    }

    /** @test */
    public function once_a_shopping_cart_item_increased_product_stock_will_decrease()
    {
        $product2 = Product::factory()->create(['stocks' => 100]);
        $cart2 = (new Cart)->addBy(
            $this->user,
            $this->getAddToCartAttributes($product2,quantity : 10)
        );

        $cart2->adjustQuantity($this->handler, 2);
        $this->assertEquals(88, $product2->refresh()->stocks );
    }

    /** @test */
    public function once_a_shopping_cart_item_increased_quantity_greater_than_product_stock_exception_will_throw()
    {
        $this->expectException(exception::class);
        $product2 = Product::factory()->create(['stocks' => 100]);
        $cart2 = (new Cart)->addBy(
            $this->user,
            $this->getAddToCartAttributes($product2,quantity : 10)
        );

        $cart2->adjustQuantity($this->handler,20000);
    }

}
