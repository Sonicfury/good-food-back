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
        $names = [
          'travail',
          'maison',
          'chez moi',
          'parents',
          'agence',
          'home'
        ];

        return [
            'name' => fake()->randomElement($names),
            'main' => fake()->boolean,
            'address1' => fake()->streetAddress,
            'zipCode' => fake()->postcode,
            'city' => fake()->city,
            'note' => fake()->realText,
            'phone' => fake()->e164PhoneNumber,
            'user_id' => rand(4, 20)
        ];
    }
}
