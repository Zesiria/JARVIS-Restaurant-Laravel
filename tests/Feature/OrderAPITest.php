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

    public function test_get_order_from_api()
    {
        $this->post('/api/foods', [
            "name" => 'Shabu',
            "type" => 'meat',
            "quantity" => 10,
            "img_path" => '1.jpg'
        ]);

        $this->post('/api/tables', [
            "size" => 2
        ]);

        $this->put('/api/tables/1', [
            "property" => "check-in",
            "number_people" => 2
        ]);

        $this->post('/api/orders', [
            "customer_id" => 1,
            "foodOrders" => [
                "food_id" => 1,
                "quantity" => 1
            ]
        ]);
        $response = $this->get('/api/orders/1');
        $response->assertStatus(200);
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
