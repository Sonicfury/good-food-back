<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => rand(0, 4),
            'isTakeaway' => true,
            'total' => rand(15.01, 50.99),
            'addresses_id' => rand(1, 10),
            'customer_id' => rand(4, 10),
            'restaurant_id' => rand(1, 5),
            'employee_id' => 3,
        ];
    }
}
