<?php
//
//namespace Tests\Feature;
//
//use App\Models\Customer;
//use App\Models\Order;
//use Illuminate\Testing\Fluent\AssertableJson;
//use Tests\TestCase;
//
//class OrderAPITest extends TestCase
//{
//    protected function setUp() : void
//    {
//        parent::setUp();
//        $this->artisan('migrate:fresh');
//    }
//
//    public function test_get_all_orders_from_api()
//    {
//        $customer = new Customer();
//        $customer->number_people = 6;
//        $customer->code = 'FOOD';
//        $customer->save();
//
//        $order = new Order();
//        $order->customer_id = $customer->id;
//        $order->save();
//
//        $order = new Order();
//        $order->customer_id = $customer->id;
//        $order->save();
//
//        $response = $this->getJson('/api/orders');
//        $response->assertStatus(200);
//        $this->assertEquals(2, collect(json_decode($response->getContent()))->count());
//    }
//
//    public function test_get_order_from_api()
//    {
//        $customer = new Customer();
//        $customer->number_people = 6;
//        $customer->code = 'FOOD';
//        $customer->save();
//
//        $order = new Order();
//        $order->customer_id = $customer->id;
//        $order->save();
//
//        $response = $this->getJson('/api/orders/1');
//        $response->assertStatus(200);
//        $response->assertJson(fn (AssertableJson $json) =>
//            $json->where('id', 1)
//                ->where('customer_id', 1)
//                ->where('status', 'COMPLETED')
//                ->etc());
//
//    }
//}
