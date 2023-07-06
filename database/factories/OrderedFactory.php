<?php

namespace Database\Factories;

use App\Models\Ordered;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ordered>
 */
class OrderedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_product = rand(0, 1);

        return [
            'comment' => fake()->text(50),
            'quantity' => rand(1, 4),
            'product_id' => $is_product == 1 ? rand(1, 20) : null,
            'menu_id' => $is_product == 0 ? rand(1, 5) : null,
            'order_id' => rand(1, 29),
        ];
    }
}
