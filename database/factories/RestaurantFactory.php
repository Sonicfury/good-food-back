<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'address1' => fake()->address,
            'zipCode' => rand(10000, 99999),
            'lat' => 50 + rand(0, 1000) / 1000,
            'long' => 2 + rand(0, 1000) / 1000,
            'city' => fake()->city,
            'phone' => fake()->phoneNumber,
        ];
    }
}
