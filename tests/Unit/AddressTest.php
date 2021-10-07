<?php

namespace Tests\Unit;

use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function address_can_only_be_created_by_auth_user()
    {

        $user = \App\Models\User::factory()->create();
        $attributes = [
            'province' => 'guangdong',
            'city' => 'guangzhou',
            'district' => 'liwan',
            'street' => 'liwan str.',
            'consignee' => 'andi liang',
            'mobile_number' => '13798060956',
        ];
        $address = (new Address)->addBy($user,$attributes);
        $this->assertEquals('guangzhou',$address->city);
    }


}
