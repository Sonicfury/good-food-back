<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Product;
use App\Models\Offer;
use App\Models\User;
use Tests\TestCase;

class OfferTest extends TestCase
{
    /**
     * @return void
     */
    public function test_offer_can_be_display_offers(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/offers');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_menu_offer_can_be_stored(): void
    {
        $user = User::factory()->create();

        $menu = Menu::factory()->create();

        $body = [
            'name' => 'test_menu_name',
            'percent' => 20.50,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/menus/'. $menu->id .'/offers', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_product_offer_can_be_stored(): void
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $body = [
            'name' => 'test_product_name',
            'percent' => 20.50,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/products/'. $product->id .'/offers', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_offer_can_be_display_offer(): void
    {
        $offer = Offer::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/offers/'. $offer->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_offer_can_be_updated(): void
    {
        $offer = Offer::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->patchJson('/api/offers/'. $offer->id, [
                'name' => 'new_name',
                'percent' => 10,
            ]);

        $new_offer = Offer::find($offer->id);

        $this->assertEquals('new_name', $new_offer->name);
        $this->assertEquals(10, $new_offer->percent);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_offer_can_be_deleted(): void
    {
        $offer = Offer::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->deleteJson('/api/offers/'. $offer->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_offer_can_belong_to_product(): void
    {
        $product = Product::factory()->create();

        $offer = Offer::factory()->create();

        $product->offers()->save($offer);

        $offerable = $offer->offerable;

        $this->assertEquals($offerable->id, $product->id);
    }

    /**
     * @return void
     */
    public function test_offer_can_belong_to_menu(): void
    {
        $menu = Menu::factory()->create();

        $offer = Offer::factory()->create();

        $menu->offers()->save($offer);

        $offerable = $offer->offerable;

        $this->assertEquals($offerable->id, $menu->id);
    }
}
