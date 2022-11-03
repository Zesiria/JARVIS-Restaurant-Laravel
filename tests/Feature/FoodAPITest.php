<?php

namespace Tests\Feature;

use App\Models\Food;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FoodAPITest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function test_get_food_from_api()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->price = 50;
        $food->img_path = "imgs/1.png";
        $food->save();

        $response = $this->getJson('/api/foods');

        $response->assertStatus(200);
        $this->assertEquals(1, collect(json_decode($response->getContent()))->count());
    }

    public function test_get_food_from_api_by_id()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->price = 50;
        $food->img_path = "imgs/1.png";
        $food->save();

        $food2 = new Food();
        $food2->name = "หมูชาบู";
        $food2->type = "เนื้อสัตว์";
        $food2->quantity = 10;
        $food2->price = 100;
        $food2->img_path = "imgs/2.png";
        $food2->save();

        $response = $this->getJson('/api/foods/1');

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->where('name', "หมูนุ่ม")->etc());
    }

    public function test_get_food_from_api_no_price()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->img_path = "imgs/1.png";
        $food->save();

        $response = $this->getJson('/api/foods/1');
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->where('price', 0)->etc());
    }

    public function test_get_food_from_api_no_img_path()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->price = 100;
        $food->save();

        $response = $this->getJson('/api/foods/1');
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->where('img_path', null)->etc());
    }

    public function test_get_food_from_api_no_price_and_img_path()
    {
        $food = new Food();
        $food->name = "หมูนุ่ม";
        $food->type = "เนื้อสัตว์";
        $food->quantity = 20;
        $food->save();

        $response = $this->getJson('/api/foods/1');
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->where('price', 0)
                ->where('img_path', null)
                ->etc()
            );
    }

    public function test_post_food_to_api()
    {
        $response = $this->postJson('api/foods', ['name' => 'หมูนุ่ม', 'type' => 'เนื้อสัตว์', 'quantity' => 20]);
        $response->assertStatus(201);
    }

    public function test_post_food_to_api_incomplete() {
        $response = $this->postJson('api/foods', ['name' => 'หมูนุ่ม', 'type' => 'เนื้อสัตว์']);
        $response->assertStatus(201);
    }

    public function test_put_food_to_api()
    {
        $response = $this->putJson('api/foods/1', ['name' => 'หมูธรรมดา', 'type' => 'เนื้อ', 'quantity' => 30, 'price' => 70.50, 'img_path' => 'imgs/000.png']);
        $response->assertStatus(200);
    }

    public function test_delete_food_from_api()
    {
        $response = $this->deleteJson('api/foods/1');
        $response->assertStatus(204);
    }
}
