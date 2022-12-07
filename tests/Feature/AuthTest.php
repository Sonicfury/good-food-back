<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_user_can_be_register(): void
    {
        $response = $this->post('/api/register', [
            'email' => 'test@example.com',
            'password' => '1234azer',
        ]);

        $this->assertCount(6, User::all());

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_user_can_be_login(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = '1234azer'),
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_register_parameter_cannot_be_null(): void
    {
        $response = $this->post('/api/register', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }
}
