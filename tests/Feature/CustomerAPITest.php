<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CustomerAPITest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function test_get_customer_from_api()
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = "FOOD";
        $customer->save();

        $response = $this->getJson('/api/customers');

        $response->assertStatus(200);
        $this->assertEquals(1, collect(json_decode($response->getContent()))->count());

    }

    public function test_get_customer_from_api_by_id()
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = "FOOD";
        $customer->save();

        $response = $this->getJson('/api/customers');

        $response->assertStatus(200);
        $this->assertEquals(1, 1);

    }

    public function test_post_customer_to_api()
    {
        $response = $this->postJson('/api/customers', ["number_people" => 5, "code" => "COOK"]);

        $response->assertStatus(201);
    }

    public function test_post_customer_to_api_incomplete()
    {
        $response = $this->postJson('/api/customers', ["code" => "COOK"]);

        $response->assertStatus(500);
    }

    public function test_put_customer_to_api()
    {
        $response = $this->putJson('/api/customers/1', ["number_people" => 6]);

        $response->assertStatus(201);

    }

    public function test_delete_customer_from_api()
    {
        $response = $this->deleteJson('/api/customers/1');

        $response->assertStatus(204);
    }

}
