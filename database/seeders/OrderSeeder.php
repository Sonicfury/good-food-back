<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Ordered;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $customers = User::role('customer')->get();

        foreach ($customers as $user){
            Order::create([
                'state' => rand(0, 4),
                'isTakeaway' => true,
                'total' => rand(15.01, 50.99),
                'addresses_id' => $user->addresses()->first()->id,
                'customer_id' => $user->id,
                'restaurant_id' => rand(1, 5),
                'employee_id' => 3,
            ]);
        }

        $orders = Order::all();

        foreach($orders as $order){
            Ordered::factory()->create(['order_id' => $order->id]);
        }
    }
}
