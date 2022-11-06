<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FoodOrderAPITest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    protected function tearDown() : void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function test_get_all_food_orders_from_api()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->img_path = "imgs/1.png";
        $food->save();


        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->food_id = $food->id;
        $foodOrder->order_id = $food->id;
        $foodOrder->quantity = 10;
        $foodOrder->save();

        $foodOrder = new FoodOrder();
        $foodOrder->food_id = $food->id;
        $foodOrder->order_id = $food->id;
        $foodOrder->quantity = 5;
        $foodOrder->save();


        $response = $this->getJson('/api/food-orders');

        $response->assertStatus(200);
        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(2, collect($responseList)->count());

    }

    public function test_get_food_order_from_api()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->img_path = "imgs/1.png";
        $food->save();


        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->food_id = $food->id;
        $foodOrder->order_id = $food->id;
        $foodOrder->quantity = 10;
        $foodOrder->save();

        $foodOrder = new FoodOrder();
        $foodOrder->food_id = $food->id;
        $foodOrder->order_id = $food->id;
        $foodOrder->quantity = 5;
        $foodOrder->save();


        $response = $this->getJson('/api/food-orders/2');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
        $json->where('quantity', 5)->etc());

    }

    public function test_post_food_order_to_api()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->img_path = "imgs/1.png";
        $food->save();


        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

        $response = $this->postJson('api/food-orders', ['food_id' => $food->id, 'order_id' => $food->id, 'quantity' => 5]);
        $response->assertStatus(201);
    }

}
