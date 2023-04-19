<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    /**
     * @return void
     */
    public function test_restaurant_can_be_display_restaurants(): void
    {
         $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/restaurants');

        $response->assertStatus(200);
    }

    public function test_restaurant_can_be_display_restaurants_with_km(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/restaurants?coords=50.494750,2.852260');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_restaurant_can_be_stored(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $body = [
            'name' => fake()->name,
            'address1' => fake()->address,
            'zipCode' => rand(10000, 99999),
            'lat' => 50 + rand(0, 1000) / 1000,
            'long' => 2 + rand(0, 1000) / 1000,
            'city' => fake()->city,
            'primaryPhone' => '0650505050',
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/restaurants', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_restaurant_can_be_display_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)
            ->getJson('/api/restaurants/'. $restaurant->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_restaurant_can_be_updated(): void
    {
        $restaurant = Restaurant::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)
            ->patchJson('/api/restaurants/'. $restaurant->id, [
                'name' => 'test name',
                'address1' => 'test address1',
                'zipCode' => 59000,
                'lat' => 50.9999990000,
                'long' => 3.9999990000,
                'city' => 'test city',
                'primaryPhone' => '0650505050',
            ]);

        $new_restaurant = Restaurant::find($restaurant->id);

        $this->assertEquals('test name', $new_restaurant->name);
        $this->assertEquals('test address1', $new_restaurant->address1);
        $this->assertEquals(59000, $new_restaurant->zipCode);
        $this->assertEquals(50.999999, $new_restaurant->lat);
        $this->assertEquals(3.999999, $new_restaurant->long);
        $this->assertEquals('test city', $new_restaurant->city);
        $this->assertEquals('0650505050', $new_restaurant->primaryPhone);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_restaurant_can_be_deleted(): void
    {
        $restaurant = Restaurant::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)
            ->deleteJson('/api/restaurants/'. $restaurant->id);

        $response->assertStatus(200);
    }

}
