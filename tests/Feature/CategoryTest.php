<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @return void
     */
    public function test_category_can_be_display_categories(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/categories');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_category_can_be_stored(): void
    {
        $user = User::factory()->create();

        $body = [
            'name' => 'test_name',
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/categories', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_category_can_be_display_category(): void
    {
        $category = Category::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/categories/'. $category->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_category_can_be_updated(): void
    {
        $category = Category::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patchJson('/api/categories/'. $category->id, [
                'name' => 'new_name',
            ]);

        $new_category = Category::find($category->id);

        $this->assertEquals('new_name', $new_category->name);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_category_can_be_deleted(): void
    {
        $category = Category::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson('/api/categories/'. $category->id);

        $response->assertStatus(200);
    }
}
