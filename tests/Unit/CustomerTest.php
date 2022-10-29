<?php

namespace Tests\Unit;

use App\Models\Customer;
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


    public function test_create_customer()
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = "FOOD";
        $customer->save();

        $this->assertEquals($customer->id, 1);
    }
}
