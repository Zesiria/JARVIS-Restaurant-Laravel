<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Food;
use App\Models\Order;
use App\Models\FoodOrder;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class FoodOrderTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    protected function tearDown() : void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function testSetOrderId()
    {
        $customer = new Customer();
        $customer->setNumberPeople(5);
        $customer->setCode();
        $customer->save();

        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->save();

        $order = new Order();
        $order->setCustomerId(1);
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->setOrderId(1);
        $this->assertEquals(1, $foodOrder->getOrderId());
    }

    public function testSetOrderIdFailed()
    {
        $this->expectException(\Exception::class);
        $customer = new Customer();
        $customer->setNumberPeople(5);
        $customer->setCode();
        $customer->save();

        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->save();

        $order = new Order();
        $order->setCustomerId(1);
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->setOrderId(2);
    }

    public function testSetFoodId()
    {
        $customer = new Customer();
        $customer->setNumberPeople(5);
        $customer->setCode();
        $customer->save();

        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/meat/1.jpg');
        $food->save();

        $food = new Food();
        $food->setName('Cabbage');
        $food->setType('vegetable');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/vegetable/2.jpg');
        $food->save();

        $order = new Order();
        $order->setCustomerId(1);
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->setFoodId(2);
        $this->assertEquals(2, $foodOrder->getFoodId());
    }

    public function testFoodIdFailed()
    {
        $this->expectException(\Exception::class);
        $customer = new Customer();
        $customer->setNumberPeople(5);
        $customer->setCode();
        $customer->save();

        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/meat/1.jpg');
        $food->save();

        $food = new Food();
        $food->setName('Cabbage');
        $food->setType('vegetable');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/vegetable/2.jpg');
        $food->save();

        $order = new Order();
        $order->setCustomerId(1);
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->setFoodId(4);
    }

    public function testSetQuantity()
    {
        $customer = new Customer();
        $customer->setNumberPeople(5);
        $customer->setCode();
        $customer->save();

        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/meat/1.jpg');
        $food->save();

        $food = new Food();
        $food->setName('Cabbage');
        $food->setType('vegetable');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/vegetable/2.jpg');
        $food->save();

        $order = new Order();
        $order->setCustomerId(1);
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->setFoodId(1);
        $foodOrder->setQuantity(2);
        $this->assertEquals(2, $foodOrder->getQuantity());
    }

    public function testSetQuantityFailed()
    {
        $this->expectException(\Exception::class);
        $customer = new Customer();
        $customer->setNumberPeople(5);
        $customer->setCode();
        $customer->save();

        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/meat/1.jpg');
        $food->save();

        $food = new Food();
        $food->setName('Cabbage');
        $food->setType('vegetable');
        $food->setQuantity(10);
        $food->setImgPath('storage/images/vegetable/2.jpg');
        $food->save();

        $order = new Order();
        $order->setCustomerId(1);
        $order->save();

        $foodOrder = new FoodOrder();
        $foodOrder->setFoodId(1);
        $foodOrder->setQuantity(0);
    }

}
