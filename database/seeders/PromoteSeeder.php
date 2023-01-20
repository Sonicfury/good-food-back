<?php

namespace Database\Seeders;

use App\Models\Promote;
use Illuminate\Database\Seeder;

class PromoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Promote::factory()
            ->count(5)
            ->create();
    }
}
