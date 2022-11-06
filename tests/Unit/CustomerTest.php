<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Table;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CustomerTest extends TestCase
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

    public function testSetNumberPeople()
    {
        $customer = new Customer();
        $customer->setNumberPeople(6);
        $this->assertEquals(6, $customer->getNumberPeople());
    }

    public function testSetNumberPeopleNegative()
    {
        $customer = new Customer();
        $customer->setNumberPeople(-1);
        $this->assertEquals(null, $customer->getNumberPeople());
    }

    public function testSetCode()
    {
        $customer = new Customer();
        $customer->setCode();
        $this->assertNotNull($customer->getCode());
    }

    public function testCalculatePrice()
    {
        $customer = new Customer();
        $customer->setNumberPeople(1);
        $customer->calculatePrice();
        $totalPrice = (1 * 219 + 1 * 39) + ((1 * 219 + 1 * 39) * 0.1);
        $this->assertEquals($totalPrice, $customer->getTotalPrice());
    }

}
