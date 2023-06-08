<?php

namespace Database\Seeders;

use App\Models\Menu;
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
        $menus = Menu::factory()
            ->count(15)
            ->create();

        foreach ($menus as $menu){
            $menu->assignMedia(["menu_image"]);
        }
    }
}
