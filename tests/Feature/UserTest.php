<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
     public function test_user_can_be_display_users(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)
            ->getJson('/api/users');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_user_can_be_stored(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $body = [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'firstname' => fake()->firstName,
            'lastname' => fake()->lastName,
            'phone' => '0650505050',
            'password' => Hash::make('1234azer'),
            'remember_token' => Str::random(10),
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/users', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_user_can_be_display_user(): void
    {
        $user = User::factory()->create();
        $user->assignRole('customer');

        $response = $this->actingAs($user)
            ->getJson('/api/users/'. $user->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_user_can_be_updated(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'email' => 'old@example.com',
            'firstname' => 'old_firstname',
            'lastname' => 'old_lastname',
            'phone' => '0650505050',
            'birthDate' => '1995-02-01',
        ]);
        $user->assignRole('customer');

        $user = User::find($user->id);

        $response = $this->actingAs($user)
            ->putJson('/api/users/'. $user->id, [
                'email' => 'new@example.com',
                'firstname' => 'new_firstname',
                'lastname' => 'new_lastname',
                'phone' => '0750505050',
                'birthDate' => '01-02-1990',
            ]);

        $new_user = User::find($user->id);

        $this->assertEquals('new@example.com', $new_user->email);
        $this->assertEquals('new_firstname', $new_user->firstname);
        $this->assertEquals('new_lastname', $new_user->lastname);
        $this->assertEquals('0750505050', $new_user->phone);
        $this->assertEquals('1990-02-01', $new_user->birthDate);

        $response->assertStatus(200);
    }
}
