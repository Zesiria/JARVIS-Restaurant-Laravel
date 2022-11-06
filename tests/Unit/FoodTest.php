<?php

namespace Tests\Unit;

use App\Models\Food;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class FoodTest extends TestCase
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

    public function testSetType()
    {
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $this->assertEquals('meat', $food->getType());
    }

    public function testSetTypeIncorrect()
    {
        $this->expectException(Exception::class);
        $food = new Food();
        $food->setName('Shrimp');
        $food->setType('seafood');
        $food->setQuantity(10);
    }

    public function testSetQuantity()
    {
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity( 10);
        $this->assertEquals(10, $food->getQuantity());
    }

    public function testSetQuantityIncorrect()
    {
        $this->expectException(Exception::class);
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity( -1);
    }

    public function testAddQuantityFood()
    {
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity( 10);
        $food->addQuantityFood(20);
        $this->assertEquals(30,$food->getQuantity());
    }

    public function testAddQuantityFoodIncorrect()
    {
        $this->expectException(Exception::class);
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity(10);
        $food->addQuantityFood(0);
    }

    public function testReduceQuantityFood()
    {
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity( 10);
        $food->reduceQuantityFood(5);
        $this->assertEquals(5,$food->getQuantity());
    }

    public function testReduceQuantityFoodLessThanOne()
    {
        $this->expectException(Exception::class);
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity( 10);
        $food->reduceQuantityFood(0);

    }

    public function testReduceQuantityFoodMoreThanAmount()
    {
        $this->expectException(Exception::class);
        $food = new Food();
        $food->setName('Shabu Pork');
        $food->setType('meat');
        $food->setQuantity( 10);
        $food->reduceQuantityFood(11);
    }

}
