<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->id = 1;
        $order->customer_id = 1;
        $order->status = "PENDING";
        $order->created_at = "2022-11-06 17:36:34";
        $order->updated_at = "2022-11-06 17:36:34";
        $order->save();

        $order = new Order();
        $order->id = 2;
        $order->customer_id = 2;
        $order->status = "PENDING";
        $order->created_at = "2022-11-06 17:36:34";
        $order->updated_at = "2022-11-06 17:36:34";
        $order->save();

        $order = new Order();
        $order->id = 3;
        $order->customer_id = 3;
        $order->status = "PENDING";
        $order->created_at = "2022-11-06 17:36:35";
        $order->updated_at = "2022-11-06 17:36:35";
        $order->save();

        $order = new Order();
        $order->id = 4;
        $order->customer_id = 4;
        $order->status = "PENDING";
        $order->created_at = "2022-11-06 17:36:36";
        $order->updated_at = "2022-11-06 17:36:36";
        $order->save();
    }
}
