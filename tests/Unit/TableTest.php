<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Table;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\TestCase;

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
     * @throws \Exception
     */
    public function testSetCustomerId()
    {
        $customer = new Customer();
        $table = new Table();
        $table->setCustomerId(2);
        $this->assertEquals(2, $table->getCustomerId());
    }

    public function test_check_out()
    {
        $customer = Customer::find(1);
        $table = new Table();
        $table->customer()->associate($customer);
        $table->size = 8;
        $table->status = 0;

        $table->checkOut();
        $this->assertEquals(true, $table->status);
    }



}
