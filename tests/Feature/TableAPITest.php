<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Table;
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
        $response->assertStatus(201)->assertJson(fn (AssertableJson $json) => $json->where('customer_id', 1)->etc());

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
        $response->assertStatus(201)->assertJson(fn (AssertableJson $json) => $json->where('customer_id', null)->etc());

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
        $response->assertStatus(200);

        $response = $this->getJson('/api/tables/1');
        $response->assertStatus(404);
    }

    /**
     * update the table feature test.
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

        $response = $this->putJson('api/tables/1', ["property" => "check-out"]);
        $response->assertStatus(200);
        $this->assertEquals(null, $table->customer_id);
        $this->assertEquals(1, $table->status);

    }
}
