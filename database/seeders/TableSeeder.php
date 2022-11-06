<?php

namespace Database\Seeders;

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
        $table->id = 1;
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->id = 2;
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->id = 3;
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->id = 4;
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->id = 5;
        $table->size = 2;
        $table->save();

        $table = new Table();
        $table->id = 6;
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->id = 7;
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->id = 8;
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->id = 9;
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->id = 10;
        $table->size = 4;
        $table->save();

        $table = new Table();
        $table->id = 11;
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->id = 12;
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->id = 13;
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->id = 14;
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->id = 15;
        $table->size = 8;
        $table->save();

        $table = new Table();
        $table->id = 16;
        $table->size = 10;
        $table->save();

        $table = new Table();
        $table->id = 17;
        $table->size = 10;
        $table->save();

        $table = new Table();
        $table->id = 18;
        $table->size = 10;
        $table->save();

        $table = new Table();
        $table->id = 19;
        $table->size = 10;
        $table->save();

        $table = new Table();
        $table->id = 20;
        $table->size = 10;
        $table->save();
    }
}
