<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * @return void
     */
    public function test_order_can_be_display_orders(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)
            ->getJson('/api/orders');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_be_display_customer_orders(): void
    {
        $user = User::factory()->create();
        $user->assignRole('customer');

        $customer = User::factory()->create();

        Order::factory()->create(['customer_id' => $customer->id]);

        $response = $this->actingAs($user)
            ->getJson('/api/customers/' . $customer->id . '/orders');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_be_display_restaurant_orders(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $restaurant = Restaurant::factory()->create();

        Order::factory()->create(['restaurant_id' => $restaurant->id]);

        $response = $this->actingAs($user)
            ->getJson('/api/restaurants/' . $restaurant->id . '/orders');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_be_display_employee_orders(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $employee = User::factory()->create();

        Order::factory()->create(['employee_id' => $employee->id]);

        $response = $this->actingAs($user)
            ->getJson('/api/employees/' . $employee->id . '/orders');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_be_stored(): void
    {
        $customer = User::factory()->create();
        $restaurant = Restaurant::factory()->create();
        $employee = User::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('customer');

        $body = [
            'state' => 'validée',
            'isTakeaway' => true,
            'total' =>  16.99,
            'customer_id' => $customer->id,
            'restaurant_id' => $restaurant->id,
            'employee_id' => $employee->id,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/orders', $body);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_be_display_order(): void
    {
        $order = Order::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('customer');

        $response = $this->actingAs($user)
            ->getJson('/api/orders/'. $order->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_be_updated(): void
    {
        $order = Order::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('customer');

        $response = $this->actingAs($user)
            ->patchJson('/api/orders/'. $order->id, [
                'state' => 'annulée',
                'customer_id' => 5,
                'restaurant_id' => 1,
                'employee_id' => 3,
            ]);

        $new_order = Order::find($order->id);

        $this->assertEquals('annulée', $new_order->state);
        $this->assertEquals(5, $new_order->customer_id);
        $this->assertEquals(1, $new_order->restaurant_id);
        $this->assertEquals(3, $new_order->employee_id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_be_deleted(): void
    {
        $order = Order::factory()->create();

        $user = User::factory()->create();
        $user->assignRole('customer');

        $response = $this->actingAs($user)
            ->deleteJson('/api/orders/'. $order->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_order_can_belong_to_customer(): void
    {
        $customer = User::factory()->create();

        $order = Order::factory()->create(['customer_id' => $customer->id]);

        $order_customer = $order->customer;

        $this->assertEquals($order_customer->id, $customer->id);
    }


    /**
     * @return void
     */
    public function test_order_can_belong_to_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $order = Order::factory()->create(['restaurant_id' => $restaurant->id]);

        $order_restaurant = $order->restaurant;

        $this->assertEquals($order_restaurant->id, $restaurant->id);
    }


    /**
     * @return void
     */
    public function test_order_can_belong_to_employee(): void
    {
        $employee = User::factory()->create();

        $order = Order::factory()->create(['employee_id' => $employee->id]);

        $order_employee = $order->employee;

        $this->assertEquals($order_employee->id, $employee->id);
    }
}
