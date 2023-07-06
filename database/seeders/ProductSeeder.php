<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $productNames = [
            'Entrées' => [
                ['name' => 'Nuggets Croustillants', 'price' => 5.99],
                ['name' => 'Ailes de Poulet', 'price' => 6.49],
                ['name' => 'Mozzarella Sticks', 'price' => 4.99],
                ['name' => 'Onion Rings', 'price' => 3.99],
                ['name' => 'Potato Skins', 'price' => 5.49],
            ],
            'Repas' => [
                ['name' => 'Le Super Burger', 'price' => 9.99],
                ['name' => 'Le Double Cheese', 'price' => 8.49],
                ['name' => 'Le Mega Chicken', 'price' => 7.99],
                ['name' => 'Le Géant Fish', 'price' => 6.99],
                ['name' => 'Le Maxi Veggie', 'price' => 7.49],
            ],
            'Boissons' => [
                ['name' => 'Soda Géant', 'price' => 2.99],
                ['name' => 'Milkshake Deluxe', 'price' => 4.49],
                ['name' => 'Smoothie Tropical', 'price' => 3.99],
                ['name' => 'Café Frappé', 'price' => 3.49],
                ['name' => 'Thé Glacé', 'price' => 2.49],
            ],
            'Desserts' => [
                ['name' => 'Sundae Caramel', 'price' => 3.99],
                ['name' => 'Fondant Chocolat', 'price' => 4.99],
                ['name' => 'Tarte aux Fruits', 'price' => 3.49],
                ['name' => 'Crème Brûlée', 'price' => 4.49],
                ['name' => 'Beignet Gourmand', 'price' => 2.99],
            ]
        ];

        foreach ($productNames['Entrées'] as $product){
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'category_id' => (Category::where('name', 'Entrées')->first())->id
            ]);
        }

        foreach ($productNames['Repas'] as $product){
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'category_id' => (Category::where('name', 'Repas')->first())->id
            ]);
        }

        foreach ($productNames['Boissons'] as $product){
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'category_id' => (Category::where('name', 'Boissons')->first())->id
            ]);
        }

        foreach ($productNames['Desserts'] as $product){
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'category_id' => (Category::where('name', 'Desserts')->first())->id
            ]);
        }

        $products = Product::all();

        foreach ($products as $product) {
            $product->assignMedia(["product_image"]);
        }
    }
}
