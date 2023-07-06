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
        $users = User::factory()
            ->count(20)
            ->create();

        foreach ($users as $user) {
            match ($user->id) {
                1 => $user->assignRole('admin'),
                2 => $user->assignRole('deliveryman'),
                3 => $user->assignRole('employee'),
                default => $user->assignRole('customer')
            };

            $addresses = Address::factory()->count(rand(1, 3))->create();

            foreach ($addresses as $address) {
                $user->addresses()->save($address);
            }
        }
    }
}
