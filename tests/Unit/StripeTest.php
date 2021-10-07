<?php
namespace Tests\Unit;

use App\Models\Address;
use App\Models\Cart;

use App\Models\StripeOrderTransaction;
use App\Usecase\Payment\CreateOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GetCartAttributes;
use Tests\CreateStripeOrderTransactionStub;
use Tests\TestCase;

class StripeTest extends TestCase
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
        $this->product = \App\Models\Product::factory()->create(['stocks' => 100]);
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
    public function once_an_order_created_a_stripe_transaction_is_recorded()
    {
        $order = new CreateOrder($this->user,$this->address,$this->orderAttributes);
        $stripe = new CreateStripeOrderTransactionStub($order,[
            'status' => 'succeeded',
            'payment_intent' => 'payment_id',
        ]);
        $stripe->handle();

        $this->assertEquals(1, StripeOrderTransaction::all()->count() );
    }


}
