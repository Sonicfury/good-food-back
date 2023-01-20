<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * @return void
     */
    public function test_product_can_be_display_products(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/products');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_product_can_be_stored(): void
    {
        $category = Category::factory()->create();

        $user = User::factory()->create();

        $body = [
            'name' => 'test_name',
            'price' => 20.50,
            'category_id' => $category->id
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/products', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_product_can_be_display_product(): void
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/products/'. $product->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_product_can_be_updated(): void
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patchJson('/api/products/'. $product->id, [
                'name' => 'new_name',
                'price' => 100.99,
                'category_id' => 2,
            ]);

        $new_product = Product::find($product->id);

        $this->assertEquals('new_name', $new_product->name);
        $this->assertEquals(100.99, $new_product->price);
        $this->assertEquals(2, $new_product->category_id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_product_can_be_deleted(): void
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson('/api/products/'. $product->id);

        $response->assertStatus(200);
    }
}
