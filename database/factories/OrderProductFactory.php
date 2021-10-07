<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::factory()->create();
        $quantity = rand(10,100);
        return [
            'product_id' => $product->id,
            'order_id' => Order::factory(),
            'product_name' => $product->name,
            'product_price' => $product->price,
            'cover' => $product->cover,
            'product_description' => $product->description,
            'quantity' => $quantity,
            'total_price' => $quantity * $product->price,
        ];
    }
}
