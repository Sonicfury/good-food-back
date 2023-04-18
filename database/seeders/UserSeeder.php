<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create();

        $admin = User::find(1);
        $deliveryman = User::find(2);
        $employee = User::find(3);

        $admin->assignRole('admin');
        $deliveryman->assignRole('deliveryman');
        $employee->assignRole('employee');
    }
}
