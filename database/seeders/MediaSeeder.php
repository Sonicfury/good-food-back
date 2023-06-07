<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ogrre\Media\Models\Media;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Media::create(['name' => "product_image", "mime_type" => ["jpg", "png"], "disk" => "public"]);
        Media::create(['name' => "menu_image", "mime_type" => ["jpg", "png"], "disk" => "public"]);
        Media::create(['name' => "category_image", "mime_type" => ["jpg", "png"], "disk" => "public"]);
    }
}
