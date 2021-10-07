<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'province' => '广东省',
            'city' => '广州市',
            'district' => '荔湾区',
            'street' => '东海南路6号',
            'consignee' => 'andi liang',
            'mobile_number' => '13798050851',
        ];
    }
}
