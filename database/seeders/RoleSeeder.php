<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::create([
            'name' => 'customer'
        ]);

        Role::create([
            'name' => 'deliveryman'
        ]);

        Role::create([
            'name' => 'employee'
        ]);

        Role::create([
            'name' => 'admin'
        ]);
    }
}
