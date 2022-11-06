<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class OrderAPITest extends TestCase
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

    public function test_get_all_orders_from_api()
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

        $response = $this->getJson('/api/orders');
        $response->assertStatus(200);
        $this->assertEquals(2, collect(json_decode($response->getContent()))->count());
    }


    // 500 Internal
    public function test_get_order_from_api()
    {
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/meat/1.jpg');
        $food->save();

        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $table = new Table();
        $table->setSize(6);
        $table->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->food_id = $food->id;
        $foodOrder->order_id = $order->id;
        $foodOrder->setQuantity(1);
        $foodOrder->save();

        $response = $this->get('/api/orders/1');
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 1)
                ->where('customer_id', 1)
                ->where('status', 'PENDING')
                ->etc());
    }

    // 500 Internal
    public function test_post_order_to_api()
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/meat/1.jpg');
        $food->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

//        $food_order = new FoodOrder();
//        $food_order->food_id = $food->id;
//        $food_order->order_id = $order->id;
//        $food_order->setQuantity(1);
//        $food_order->save();

        $response = $this->postJson('api/orders', ["customer_id" => 1, "foodOrders" => ['food_id' => 1, 'orderQuantity' => 1]]);
        $response->assertStatus(201);
    }

    public function test_put_order_to_api()
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();

        $response = $this->putJson('api/orders/1', ['status' => 'accept']);
        $response->assertStatus(200);

    }

}
