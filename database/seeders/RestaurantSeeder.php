<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $restaurants = Restaurant::factory()
            ->count(5)
            ->create();

        foreach ($restaurants as $restaurant){
            $restaurant->assignMedia(["restaurant_image"]);
        }
    }
}
