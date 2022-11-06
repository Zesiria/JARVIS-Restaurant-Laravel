<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Table;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TableTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
    }

    protected function tearDown() : void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function testSetCustomerId()
    {
        for ($i = 0; $i < 10; ++$i) {
            $customer = new Customer();
            $customer->setNumberPeople(6);
            $customer->setCode();
            $customer->save();
            $table = new Table();
            $table->setSize(6);
            $table->save();
        }
        $table = Table::all()->first();
        $table->setCustomerId(2);
        $this->assertEquals(2, $table->getCustomerId());
    }

    public function testSetCustomerIdIncorrect()
    {
        for ($i = 0; $i < 10; ++$i) {
            $customer = new Customer();
            $customer->setNumberPeople(6);
            $customer->setCode();
            $customer->save();
            $table = new Table();
            $table->setSize(6);
            $table->save();
        }
        $this->expectException(Exception::class);
        $table = Table::all()->first();
        $table->setCustomerId(11);
    }

    public function testSetSize()
    {
        $table = new Table();
        $table->setSize(10);
        $this->assertEquals(10, $table->getSize());
    }

    public function testSetSizeIncorrect()
    {
        $table = new Table();
        $this->expectException(Exception::class);
        $table->setSize(11);
    }

    public function testCheckOut()
    {
        $customer = new Customer();
        $customer->setNumberPeople(6);
        $customer->setCode();
        $customer->save();
        $table = new Table();
        $table->setSize(6);
        $table->save();

        $table->checkOut();
        $this->assertNull($table->getCustomerId());
        $this->assertTrue($table->getStatus());
    }

    public function testCheckIn()
    {
        $customer = new Customer();
        $customer->setNumberPeople(6);
        $customer->setCode();
        $customer->save();
        $table = new Table();
        $table->setSize(6);
        $table->save();

        $table->checkIn(1);
        $this->assertNotNull($table->getCustomerId());
        $this->assertFalse($table->getStatus());
    }



}
