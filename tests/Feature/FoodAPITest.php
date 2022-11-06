<?php

namespace Tests\Feature;

use App\Models\Food;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FoodAPITest extends TestCase
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

    public function test_get_food_from_api()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->img_path = "imgs/1.png";
        $food->save();

        $response = $this->getJson('/api/foods');

        $response->assertStatus(200);
        $this->assertEquals(1, collect(json_decode($response->getContent()))->count());
    }

    public function test_get_food_from_api_by_id()
    {
        $food = new Food();
        $food->name = 'Soft Pork';
        $food->type = 'meat';
        $food->quantity = 20;
        $food->img_path = "imgs/1.png";
        $food->save();

        $food2 = new Food();
        $food2->name = 'Shabu Pork';
        $food2->type = 'meat';
        $food2->quantity = 10;
        $food2->img_path = "imgs/2.png";
        $food2->save();

        $response = $this->getJson('/api/foods/1');

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->where('name', 'Soft Pork')->etc());
    }

    public function test_post_food_to_api()
    {
        $response = $this->postJson('api/foods', ['name' => 'Soft Pork', 'type' => 'meat', 'quantity' => 20, 'img_path' => 'imgs/1.png']);
        $response->assertStatus(201);
    }

    public function test_post_food_to_api_incomplete() {
        $response = $this->postJson('api/foods', ['name' => 'Soft Pork', 'type' => 'meat']);
        $response->assertStatus(400);
    }

    public function test_put_food_to_api()
    {
        $food = new Food();
        $food->name = 'Shabu Pork';
        $food->type = 'meat';
        $food->quantity = 10;
        $food->img_path = "imgs/2.png";
        $food->save();

        $response = $this->putJson('api/foods/1', ['img_path' => 'imgs/000.png']);
        $response->assertStatus(200);
    }

    public function test_delete_food_from_api()
    {
        $response = $this->deleteJson('api/foods/1');
        $response->assertStatus(400);
    }
}
