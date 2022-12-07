<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
     public function test_can_be_display_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/users');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_be_display_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/users/'. $user->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_user_can_be_updated(): void
    {
        $user = User::factory()->create([
            'email' => 'old@example.com',
            'firstname' => 'old_firstname',
            'lastname' => 'old_lastname',
            'primaryPhone' => '0650505050',
            'secondaryPhone' => '0350505050',
        ]);

        $response = $this->actingAs($user)
            ->put('/api/users/'. $user->id, [
                'email' => 'new@example.com',
                'firstname' => 'new_firstname',
                'lastname' => 'new_lastname',
                'primaryPhone' => '0750505050',
                'secondaryPhone' => '0250505050',
            ]);

        $new_user = User::find($user->id);

        $this->assertEquals('new@example.com', $new_user->email);
        $this->assertEquals('new_firstname', $new_user->firstname);
        $this->assertEquals('new_lastname', $new_user->lastname);
        $this->assertEquals('0750505050', $new_user->primaryPhone);
        $this->assertEquals('0250505050', $new_user->secondaryPhone);

        $response->assertStatus(200);
    }
}
