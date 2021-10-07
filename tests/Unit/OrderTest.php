<?php
namespace Tests\Unit;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;

use App\Usecase\Payment\CreateOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GetCartAttributes;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    use GetCartAttributes;

    private $orderAttributes = [
        'payment_method' => 'credit_card',
        'payment_vendor' => 'stripe',
        'status' => 'paid',
    ];

    private $user;
    private $product;
    private $address;

    private $cart;

    public function setUp() :void
    {
        parent::setUp();
        $this->user = \App\Models\User::factory()->create();
        $this->product = \App\Models\Product::factory()->create(['stocks' => 100 , 'price' => 1]);
        $this->address = (new address)->addBy($this->user,  [
            'province' => 'guangdong',
            'city' => 'guangzhou',
            'district' => 'liwan',
            'street' => 'liwan str.',
            'consignee' => 'andi liang',
            'mobile_number' => '13798060956',
        ]);

        $this->cart = (new Cart)->addBy($this->user, $this->getAddToCartAttributes($this->product,5) );
    }
    /** @test */
    public function an_order_can_be_created()
    {
        $createOrder = (new CreateOrder($this->user,$this->address,$this->orderAttributes))->handle();
        $this->assertEquals(1, Order::all()->count() );
    }

    /** @test */
    public function order_can_be_created_when_customer_checkout_with_shopping_cart()
    {
        $quantity = 5;
        $product = \App\Models\Product::factory()->create(['price' => 5]);
        $product2 = \App\Models\Product::factory()->create(['price' => 10]);

         (new Cart)->addBy($this->user, $this->getAddToCartAttributes($product,$quantity) ); //5 * 5 =25
         (new Cart)->addBy($this->user,  $this->getAddToCartAttributes($product2,$quantity) ); //10 * 5 = 50

        $order = (new CreateOrder($this->user,$this->address,$this->orderAttributes))->handle();

        $this->assertEquals(3, $order->refresh()->orderProducts->count());
        $this->assertEquals(0, Cart::all()->count() );
        $this->assertEquals(80, $order->refresh()->total_price );
    }

    /** @test */
    public function once_order_is_created_order_address_is_recorded()
    {
        $order = (new CreateOrder($this->user,$this->address,$this->orderAttributes))->handle();
        $this->assertEquals( 'andi liang', $order->address->consignee);
    }
}
