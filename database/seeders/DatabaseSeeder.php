<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(FoodOrderSeeder::class);
        $this->call(CustomerOrderSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
