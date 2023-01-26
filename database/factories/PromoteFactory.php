<?php

namespace Database\Factories;

use App\Models\Promote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Promote>
 */
class PromoteFactory extends Factory
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
            'percent' => rand(5, 55),
            'product_id' => rand(1,5),
        ];
    }
}
