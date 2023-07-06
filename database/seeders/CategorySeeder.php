<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categoriesNames = [
            'Repas',
            'Boissons',
            'Desserts',
            'Entrées',
        ];

        foreach ($categoriesNames as $category){
            Category::create([
                'name' => $category
            ]);
        }

        $categories = Category::all();

        foreach ($categories as $category){
            $category->assignMedia(["category_image"]);
        }
    }
}
