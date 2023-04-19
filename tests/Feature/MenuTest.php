<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class MenuTest extends TestCase
{
    /**
     * @return void
     */
    public function test_menu_can_be_display_menus(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/menus');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_menu_can_be_stored(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $body = [
            'name' => 'test_name',
            'price' => 20.50
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/menus', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_menu_can_be_display_menu(): void
    {
        $menu = Menu::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/menus/'. $menu->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_menu_can_be_updated(): void
    {
        $menu = Menu::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)
            ->patchJson('/api/menus/'. $menu->id, [
                'name' => 'new_name',
                'price' => 100.99
            ]);

        $new_menu = Menu::find($menu->id);

        $this->assertEquals('new_name', $new_menu->name);
        $this->assertEquals(100.99, $new_menu->price);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_menu_can_be_deleted(): void
    {
        $menu = Menu::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)
            ->deleteJson('/api/menus/'. $menu->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_menu_can_have_product(): void
    {
        $menu = Menu::factory()->create();

        $product = Product::factory()->create();

        $menu->products()->attach($product->id);

        $menu_products = $menu->products;

        $this->assertEquals($menu_products[0]->id, $product->id);
    }

    /**
     * @return void
     */
    public function test_menu_can_have_offer(): void
    {
        $menu = Menu::factory()->create();

        $offer = Offer::factory()->create();

        $menu->offers()->save($offer);

        $menu_offer = collect($menu->offers)->where('offerable_id', $offer->offerable_id)->first();

        $this->assertEquals($menu_offer->offerable_id, $offer->offerable_id);
    }
}
