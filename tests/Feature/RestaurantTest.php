<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            ->get('/api/restaurants');

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
            ->get('/api/restaurants/'. $restaurant->id);

        $response->assertStatus(200);
    }
}
