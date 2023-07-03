<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'main' => fake()->boolean,
            'address1' => fake()->streetAddress,
            'zipCode' => fake()->postcode,
            'city' => fake()->city,
            'note' => fake()->realText,
            'phone' => fake()->e164PhoneNumber,
            'user_id' => rand(1, 5)
        ];
    }
}
