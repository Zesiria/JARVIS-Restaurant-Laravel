<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new Customer();
        $customer->number_people = 2;
        $customer->code = "rrdleo";
        $customer->price = 567.6;
        $customer->created_at = "2022-11-06 17:36:34";
        $customer->updated_at = "2022-11-06 17:36:34";
        $customer->save();

       $customer = new Customer();
        $customer->number_people = 4;
        $customer->code = "qeqhxt";
        $customer->price = 1135.2;
        $customer->created_at = "2022-11-06 17:36:34";
        $customer->updated_at = "2022-11-06 17:36:34";
        $customer->save();

       $customer = new Customer();
        $customer->number_people = 8;
        $customer->code = "zcphph";
        $customer->price = 2270.4;
        $customer->created_at = "2022-11-06 17:36:34";
        $customer->updated_at = "2022-11-06 17:36:34";
        $customer->save();

        $customer = new Customer();
        $customer->number_people = 10;
        $customer->code = "fnjxpy";
        $customer->price = 2838.0;
        $customer->created_at = "2022-11-06 17:36:34";
        $customer->updated_at = "2022-11-06 17:36:34";
        $customer->save();
    }
}
