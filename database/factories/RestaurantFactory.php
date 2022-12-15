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
            'name' => fake()->name,
            'address1' => fake()->address,
            'zipCode' => rand(10000, 99999),
            'city' => fake()->city,
            'primaryPhone' => fake()->phoneNumber,
        ];
    }
}
