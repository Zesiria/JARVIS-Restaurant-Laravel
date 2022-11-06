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

    /**
     * @throws Exception
     */
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
        $table->setCustomerId(2);
        $this->assertEquals(2, $table->getCustomerId());
    }

    public function testSetSize()
    {
        $table = new Table();
        $table->setSize(10);
        $this->assertEquals(10, $table->getSize());
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
    }



}
