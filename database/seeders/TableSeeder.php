<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Table();
        $table->size = 2;
        $table->checkIn(1);
        $table->save();

        $table = new Table();
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->size = 4;
        $table->checkIn(2);
        $table->save();

        $table = new Table();
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->size = 8;
        $table->checkIn(3);
        $table->save();

        $table = new Table();
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->size = 10;
        $table->checkIn(4);
        $table->save();

        $table = new Table();
        $table->size = 10;
        $table->save();

        $table = new Table();
        $table->size = 10;
        $table->save();

        $table = new Table();
        $table->size = 10;
        $table->save();

        $table = new Table();
        $table->size = 10;
        $table->save();
    }
}
