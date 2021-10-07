<?php
namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_user_count_before_the_last_thirty_days()
    {
        $this->createDummyUsers();
        $total_count = User::count();
        $last_thirty_day_count = User::BeforeLastThirtyDays()->count();
        $rate = ( $total_count - $last_thirty_day_count) / $total_count;
        $this->assertEquals(2, User::BeforeLastThirtyDays()->count() );
        $this->assertEquals(0.33, round($rate,2));
    }

    /** @test */
    public function it_can_get_order_count_before_the_last_thirty_days()
    {
        $this->createDummyOrders();
        $this->assertEquals(300, Order::query()->BeforeLastThirtyDays()->sum('total_price') );
    }


    /** @test */
    public function it_can_get_order_product_count_before_the_last_thirty_days()
    {
        $this->createDummyOrderProducts();
        $this->assertEquals(300, OrderProduct::query()->BeforeLastThirtyDays()->sum('quantity'));
    }

    public function createDummyUsers()
    {
        $user = User::factory()->create(['created_at' => now()->subDays(40) ]);
        $user2 = User::factory()->create(['created_at' => now()->subDays(31) ]);
        $user3 = User::factory()->create();
    }

    public function createDummyOrders()
    {
        $order = Order::factory()->create(['created_at' => now()->subDays(40),'total_price' => 100 ]);
        $order2 = Order::factory()->create(['created_at' => now()->subDays(31),'total_price' => 200 ]);
        $order3 = Order::factory()->create(['total_price' => 20]);
    }

    public function createDummyOrderProducts()
    {
        $orderProduct = OrderProduct::factory()->create(['created_at' => now()->subDays(40),'quantity' => 100 ]);
        $orderProduct2 = OrderProduct::factory()->create(['created_at' => now()->subDays(31),'quantity' => 200 ]);
        $orderProduct3 = OrderProduct::factory()->create(['quantity' => 20]);
    }
}
