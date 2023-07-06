<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $menu_offers = Offer::factory()
            ->count(2)
            ->create();
        foreach ($menu_offers as $offer){
            $menu = Menu::find(rand(1,5));

            $menu->offers()->save($offer);
        }

        $product_offers = Offer::factory()
            ->count(7)
            ->create();
        foreach ($product_offers as $offer){
            $product = Product::find(rand(1,20));

            $product->offers()->save($offer);
        }
    }
}
