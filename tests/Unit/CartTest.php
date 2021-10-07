<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\GetCartAttributes;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    use GetCartAttributes;

    protected $user;
    protected $product;
    protected $quantity = 1;
    protected $attributes;

    public function setUp() :void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create([
            'stocks' => 100
        ]);

        $total = $this->product->price * $this->quantity ;
        $this->attributes = $this->getAddToCartAttributes($this->product,quantity : $this->quantity) ;
    }

    /** @test */
    public function a_product_can_be_added_to_a_shopping_cart()
    {
        $cart = (new Cart)->addBy($this->user,$this->attributes);
        $this->assertEquals(1, Cart::all()->count() );
    }

    /** @test */
    public function if_the_same_product_add_to_a_cart_a_new_record_should_not_be_created_and_quantity_should_be_updated()
    {
        $cart = (new Cart)->addBy($this->user,$this->attributes);
        $this->attributes['quantity'] = 5 ;
        $cart2 = (new Cart)->addBy($this->user,$this->attributes);
        $this->assertEquals(1, Cart::all()->count() );
        $this->assertEquals(6, $cart2->refresh()->quantity );
    }

    /** @test */
    public function a_shopping_cart_can_be_removed()
    {
        $cart = (new Cart)->addBy($this->user,$this->attributes);
        $this->assertEquals(99, $this->product->fresh()->stocks );

        $cart->removal()->remove();
        //making sure the product quantity is increased once the shopping cart removed
        $this->assertEquals(100, $this->product->fresh()->stocks );
        $this->assertEquals(0, Cart::all()->count() );
    }

    /** @test */
    public function a_product_stock_will_be_decrease_if_added_to_cart()
    {
        $product = Product::factory()->create(['stocks' => 100]);
        $quantity = 5;
        $cart = (new Cart)->addBy($this->user, $this->getAddToCartAttributes($product,$quantity));

        $this->assertEquals(95, $product->fresh()->stocks );
    }

    /** @test */
    public function a_user_can_remove_his_shopping_cart()
    {
        $this->attributes['quantity']  = 5;
        $cart1 = (new Cart)->addBy($this->user,$this->attributes);
        $product2 = Product::factory()->create();
        $cart2 = (new Cart)->addBy($this->user, $this->getAddToCartAttributes($product2,quantity : 10));

        $this->assertEquals(2, $this->user->carts->count() );
        (new Cart)->removal()->removeAll($this->user);
        $this->assertEquals(0, $this->user->fresh()->carts->count() );
    }

    /** @test */
    public function shopping_carts_that_existed_for_the_last_seven_days_will_be_deleted()
    {
        $this->travelTo(now()->subDays(7)->subHours(1));
        $product = Product::factory()->create(['stocks' => 100,'name' => 'a product from the past']);
        $cart = (new Cart)->addBy(
            $this->user,
            $this->getAddToCartAttributes($product,quantity : 10)
        );

        $this->travelBack();
        $product2 = Product::factory()->create(['stocks' => 100,'name' => 'a product from now']);
        $cart2 = (new Cart)->addBy(
            $this->user,
            $this->getAddToCartAttributes($product2,quantity : 10)
        );

        (new Cart)->removal()->removeFrom(7);
        $this->assertEquals(1, Cart::count() );
        $this->assertEquals($product2->id, Cart::first()->product_id );
    }

}
