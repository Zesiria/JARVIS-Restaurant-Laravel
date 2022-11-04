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

    public function testSetCode()
    {
        $customer = new Customer();
        $customer->setCode();
        $this->assertNotNull($customer->getCode());
    }

    public function testTable()
    {
        $customer = new Customer();
        $customer->belongsTo(Table::class);
        $this->assertNotNull($customer->table());
    }

//    public function testOrder()
//    {
//        $customer = new Customer();
//        $customer->hasMany(Order::class);
//        $this->assertNotNull($customer->order());
//    }
//
//    public function testFindCustomerById()
//    {
//        for ($i = 0; $i < 10; $i++) {
//            $customer = new Customer();
//        }
//        $this->assertEquals(5, Customer::findCustomerById(5));
//    }
}
