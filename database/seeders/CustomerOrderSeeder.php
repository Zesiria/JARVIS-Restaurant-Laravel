<?php

namespace Database\Seeders;

use App\Models\CustomerOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 1;
        $customerOrder->customer_id = 1;
        $customerOrder->order_id = 1;
        $customerOrder->food_id = 1;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 1;
        $customerOrder->customer_id = 1;
        $customerOrder->order_id = 1;
        $customerOrder->food_id = 2;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 1;
        $customerOrder->customer_id = 1;
        $customerOrder->order_id = 1;
        $customerOrder->food_id = 3;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 1;
        $customerOrder->customer_id = 1;
        $customerOrder->order_id = 1;
        $customerOrder->food_id = 4;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 1;
        $customerOrder->customer_id = 1;
        $customerOrder->order_id = 1;
        $customerOrder->food_id = 5;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 6;
        $customerOrder->customer_id = 2;
        $customerOrder->order_id = 2;
        $customerOrder->food_id = 6;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 6;
        $customerOrder->customer_id = 2;
        $customerOrder->order_id = 2;
        $customerOrder->food_id = 7;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 6;
        $customerOrder->customer_id = 2;
        $customerOrder->order_id = 2;
        $customerOrder->food_id = 8;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 6;
        $customerOrder->customer_id = 2;
        $customerOrder->order_id = 2;
        $customerOrder->food_id = 9;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 6;
        $customerOrder->customer_id = 2;
        $customerOrder->order_id = 2;
        $customerOrder->food_id = 10;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 11;
        $customerOrder->customer_id = 3;
        $customerOrder->order_id = 3;
        $customerOrder->food_id = 11;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 11;
        $customerOrder->customer_id = 3;
        $customerOrder->order_id = 3;
        $customerOrder->food_id = 12;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 11;
        $customerOrder->customer_id = 3;
        $customerOrder->order_id = 3;
        $customerOrder->food_id = 13;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 11;
        $customerOrder->customer_id = 3;
        $customerOrder->order_id = 3;
        $customerOrder->food_id = 14;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 11;
        $customerOrder->customer_id = 3;
        $customerOrder->order_id = 3;
        $customerOrder->food_id = 15;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 16;
        $customerOrder->customer_id = 4;
        $customerOrder->order_id = 4;
        $customerOrder->food_id = 16;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 16;
        $customerOrder->customer_id = 4;
        $customerOrder->order_id = 4;
        $customerOrder->food_id = 17;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 16;
        $customerOrder->customer_id = 4;
        $customerOrder->order_id = 4;
        $customerOrder->food_id = 18;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 16;
        $customerOrder->customer_id = 4;
        $customerOrder->order_id = 4;
        $customerOrder->food_id = 19;
        $customerOrder->quantity = 5;
        $customerOrder->save();

        $customerOrder = new CustomerOrder();
        $customerOrder->table_id = 16;
        $customerOrder->customer_id = 4;
        $customerOrder->order_id = 4;
        $customerOrder->food_id = 20;
        $customerOrder->quantity = 5;
        $customerOrder->save();
    }
}
