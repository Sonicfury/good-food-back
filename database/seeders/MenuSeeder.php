<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $menuNames = [
            [
                'name' => 'Menu Classique',
                'price' => 12.99,
                'items' => [
                    'Le Super Burger',
                    'Soda Géant',
                    'Fondant Chocolat'
                ]
            ],
            [
                'name' => 'Menu Deluxe',
                'price' => 15.99,
                'items' => [
                    'Le Double Cheese',
                    'Milkshake Deluxe',
                    'Beignet Gourmand'
                ]
            ],
            [
                'name' => 'Menu Végétarien',
                'price' => 11.99,
                'items' => [
                    'Le Maxi Veggie',
                    'Thé Glacé',
                    'Tarte aux Fruits'
                ]],
            [
                'name' => 'Menu Poulet',
                'price' => 13.99,
                'items' => [
                    'Le Mega Chicken',
                    'Soda Géant',
                    'Crème Brûlée'
                ]
            ],
            ['name' => 'Menu Fish',
                'price' => 12.49,
                'items' => [
                    'Le Géant Fish',
                    'Café Frappé',
                    'Sundae Caramel'
                ]
            ]
        ];

        foreach ($menuNames as $menu) {
            $new_menu = Menu::create([
                'name' => $menu['name'],
                'price' => $menu['price'],
            ]);

            foreach ($menu['items'] as $item) {
                $product = Product::where('name', $item)->first();

                $new_menu->products()->attach($product->id);
            }
        }

        $menus = Menu::all();

        foreach ($menus as $menu) {
            $menu->assignMedia(["menu_image"]);
        }
    }
}
