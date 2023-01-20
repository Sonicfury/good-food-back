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
    public function test_restaurant_can_be_display_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/restaurants/'. $restaurant->id);

        $response->assertStatus(200);
    }
}
