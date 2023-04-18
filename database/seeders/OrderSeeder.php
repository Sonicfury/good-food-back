<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Ordered;
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
        $orders = Order::factory()
            ->count(30)
            ->create();

        foreach($orders as $order){
            Ordered::factory()->create(['order_id' => $order->id]);
        }
    }
}
