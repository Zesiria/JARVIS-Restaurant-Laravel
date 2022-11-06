<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Table;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableAPITest extends TestCase
{

    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    protected function tearDown() : void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    /**
     * Display a listing of tables feature test.
     *
     * @return void
     */
    public function test_get_all_tables_from_api(): void
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $table = new Table();
        $table->customer_id = $customer->id;
        $table->size = 6;
        $table->save();

        $customer = new Customer();
        $customer->number_people = 8;
        $customer->code = 'Buffet';
        $customer->save();

        $table = new Table();
        $table->customer_id = $customer->id;
        $table->size = 10;
        $table->save();

        $response = $this->getJson('/api/tables');

        $response->assertStatus(200);
        $this->assertEquals(2, collect(json_decode($response->getContent()))->count());
    }

    /**
     * Display a table feature test.
     *
     * @return void
     */
    public function test_get_table_from_api(): void
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $table = new Table();
        $table->customer_id = $customer->id;
        $table->size = 6;
        $table->status = 0;
        $table->save();

        $customer = new Customer();
        $customer->number_people = 8;
        $customer->code = 'Buffet';
        $customer->save();

        $table = new Table();
        $table->customer_id = $customer->id;
        $table->size = 10;
        $table->status = 0;
        $table->save();

        $response = $this->getJson('/api/tables/2');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
        $json->where('size', 10)->etc());
    }

    /**
     * Create a table feature test.
     *
     * @return void
     */
    public function test_post_table_to_api(): void
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $response = $this->postJson('api/tables', ['customer_id' => $customer->id, 'size' => 6]);
        $response->assertStatus(201);

    }

    /**
     * Create a table without customer_id feature test.
     *
     * @return void
     */
    public function test_post_table_to_api_no_customer_id(): void
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $response = $this->postJson('api/tables', ['size' => 6]);
        $response->assertStatus(201)->assertJson(fn (AssertableJson $json) => $json->where('size', 6)->etc());

    }

    /**
     * Create a table without size feature test.
     *
     * @return void
     */
    public function test_post_table_to_api_no_size(): void
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $response = $this->postJson('api/tables', ['customer_id' => $customer->id]);
        $response->assertStatus(400);

    }

    /**
     * Update the table check out feature test.
     *
     * @return void
     */
    public function test_put_table_to_api_check_out(): void
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $table = new Table();
        $table->customer_id = $customer->id;
        $table->size = 6;
        $table->status = 0;
        $table->save();

        $response = $this->put('api/tables/1', ["property" => "check-out"]);
        $response->assertStatus(200);
        $this->assertEquals(1, Table::findTableById(1)->getStatus());
        $this->assertNull(Table::findTableById(1)->getCustomerId());

    }

    /**
     * Update the table check in feature test.
     *
     * @return void
     */
    public function test_put_table_to_api_check_in(): void
    {

        $table = new Table();
        $table->customer_id = null;
        $table->size = 6;
        $table->status = 1;
        $table->save();

        $response = $this->put('api/tables/1', ["property" => "check-in", "number_people" => 6]);
        $response->assertStatus(200);
        $this->assertEquals(0, Table::findTableById(1)->getStatus());
        $this->assertEquals(1, Table::findTableById(1)->getCustomerId());

    }

    /**
     * Delete the table feature test.
     *
     * @return void
     */
    public function test_can_not_delete_table_from_api(): void
    {
        $customer = new Customer();
        $customer->number_people = 6;
        $customer->code = 'FOOD';
        $customer->save();

        $table = new Table();
        $table->customer_id = $customer->id;
        $table->size = 6;
        $table->status = 0;
        $table->save();

        $response = $this->deleteJson('/api/tables/1');

        $response->assertStatus(400);
        $this->assertEquals(1, Table::all()->first()->getId());

    }
}
