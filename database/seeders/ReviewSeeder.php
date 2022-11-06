<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $review = new Review();
        $review->customer_id = 1;
        $review->description = "อร่อยคุ้มค่า";
        $review->save();

        $review = new Review();
        $review->customer_id = 2;
        $review->description = "คุ้มราคามากค่ะ";
        $review->save();

        $review = new Review();
        $review->customer_id = 3;
        $review->description = "อาหารให้เลือกเยอะมากสมราคา";
        $review->save();
    }
}
