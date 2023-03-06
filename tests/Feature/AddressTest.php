<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;

use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * @return void
     */
    public function test_address_can_be_display_addresses(): void
    {
        Address::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/addresses');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_address_can_be_stored(): void
    {
        $user = User::factory()->create();

        $body = [
            'name' => 'test1',
            'address1' => 'rue test1',
            'zipCode' => '62410',
            'city' => 'wingles',
            'note' => 'lorem ipsum'
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/users/'. $user->id .'/addresses', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_address_can_be_display_address(): void
    {
        $address = Address::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/addresses/'. $address->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_address_can_be_updated(): void
    {
        $address = Address::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patchJson('/api/addresses/'. $address->id, [
                'name' => 'test',
                'address1' => 'rue test',
                'zipCode' => '62410',
                'city' => 'wingles',
                'note' => 'lorem ipsum',
                'user_id' => $user->id
            ]);

        $new_address = Address::find($address->id);

        $this->assertEquals('test', $new_address->name);
        $this->assertEquals('rue test', $new_address->address1);
        $this->assertEquals('62410', $new_address->zipCode);
        $this->assertEquals('wingles', $new_address->city);
        $this->assertEquals('lorem ipsum', $new_address->note);
        $this->assertEquals($user->id, $new_address->user_id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_address_can_be_deleted(): void
    {
        $address = Address::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson('/api/addresses/'. $address->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_address_can_belong_to_user(): void
    {
        $user = User::factory()->create();

        $address = Address::factory()->create(['user_id' => $user->id]);

        $address_user = $address->user;

        $this->assertEquals($address_user->id, $user->id);
    }
}
