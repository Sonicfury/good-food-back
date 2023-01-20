<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Promote;
use App\Models\User;
use Tests\TestCase;

class PromoteTest extends TestCase
{
    /**
     * @return void
     */
    public function test_promote_can_be_display_promotes(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/promotes');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_promote_can_be_stored(): void
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();

        $body = [
            'name' => 'test_name',
            'percent' => 20.50,
            'product_id' => $product->id
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/promotes', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_promote_can_be_display_promote(): void
    {
        $promote = Promote::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/promotes/'. $promote->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_promote_can_be_updated(): void
    {
        $promote = Promote::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patchJson('/api/promotes/'. $promote->id, [
                'name' => 'new_name',
                'percent' => 10,
                'product_id' => 2,
            ]);

        $new_promote = Promote::find($promote->id);

        $this->assertEquals('new_name', $new_promote->name);
        $this->assertEquals(10, $new_promote->percent);
        $this->assertEquals(2, $new_promote->product_id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_promote_can_be_deleted(): void
    {
        $promote = Promote::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson('/api/promotes/'. $promote->id);

        $response->assertStatus(200);
    }
}
