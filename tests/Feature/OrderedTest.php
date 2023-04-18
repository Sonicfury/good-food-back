<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Ordered;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderedTest extends TestCase
{
    /**
     * @return void
     */
    public function test_ordered_can_be_display_ordereds(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/ordereds');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_ordered_can_be_display_order_ordereds(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();

        Ordered::factory()->create(['order_id' => $order->id]);

        $response = $this->actingAs($user)
            ->getJson('/api/orders/' . $order->id . '/ordereds');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_ordered_menu_can_be_stored(): void
    {
        $order = Order::factory()->create();
        $menu = Menu::factory()->create();

        $user = User::factory()->create();

        $body = [
            'comment' => 'comment test',
            'quantity' => 1,
            'order_id' => $order->id,
            'menu_id' => $menu->id,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/ordereds', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_ordered_product_can_be_stored(): void
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();

        $user = User::factory()->create();

        $body = [
            'comment' => 'comment test',
            'quantity' => 1,
            'order_id' => $order->id,
            'product_id' => $product->id,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/ordereds', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_ordered_can_be_display_ordered(): void
    {
        $ordered = Ordered::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/ordereds/'. $ordered->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_ordered_can_be_updated(): void
    {
        $ordered = Ordered::factory()->create();
        $order = Order::factory()->create();
        $product = Product::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patchJson('/api/ordereds/'. $ordered->id, [
                'comment' => 'comment',
                'quantity' => 2,
                'order_id' => $order->id,
                'product_id' => $product->id,
            ]);

        $new_ordered = Ordered::find($ordered->id);

        $this->assertEquals('comment', $new_ordered->comment);
        $this->assertEquals(2, $new_ordered->quantity);
        $this->assertEquals($order->id, $new_ordered->order_id);
        $this->assertEquals($product->id, $new_ordered->product_id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_ordered_can_be_deleted(): void
    {
        $ordered = Ordered::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson('/api/ordereds/'. $ordered->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_ordered_can_belong_to_order(): void
    {
        $order = Order::factory()->create();

        $ordered = Ordered::factory()->create(['order_id' => $order->id]);

        $ordered_order = $ordered->order;

        $this->assertEquals($ordered_order->id, $order->id);
    }
}
