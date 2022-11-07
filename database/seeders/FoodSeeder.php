<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $food = new Food();
        $food->name= "หมูนุ่ม";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_10หมูนุ่ม.jpg";
//        $food->created_at = "2022-11-04 14:21:33";
//        $food->updated_at= "2022-11-04 14:21:33";
        $food->save();

        $food = new Food();
        $food->name= "หมูชาบู";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_11หมูชาบู.jpg";
//        $food->created_at = "2022-11-04 14:21:36";
//        $food->updated_at= "2022-11-04 14:21:36";
        $food->save();

        $food = new Food();
        $food->name= "เนื้อวัว";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_12เนื้อวัว.jpg";
//        $food->created_at = "2022-11-04 14:21:38";
//        $food->updated_at= "2022-11-04 14:21:38";
        $food->save();

        $food = new Food();
        $food->name = "เนื้อไก่";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_13เนื้อไก่.jpg";
//        $food->created_at = "2022-11-04 14:21:38";
//        $food->updated_at= "2022-11-04 14:21:38";
        $food->save();

        $food = new Food();
        $food->name= "หมึกกรอบ";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_14หมึกกรอบ.jpg";
//        $food->created_at = "2022-11-04 14:21:38";
//        $food->updated_at= "2022-11-04 14:21:38";
        $food->save();

        $food = new Food();
        $food->name= "แมงกะพรุน";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_15แมงกะพรุน.jpg";
//        $food->created_at = "2022-11-04 14:21:38";
//        $food->updated_at= "2022-11-04 14:21:38";
        $food->save();

        $food = new Food();
        $food->name= "ลูกชิ้นกุ้ง";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_16ลูกชิ้นกุ้ง.jpg";
//        $food->created_at = "2022-11-04 14:21:38";
//        $food->updated_at= "2022-11-04 14:21:38";
        $food->save();

        $food = new Food();
        $food->name= "เต้าหู้ปลา";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_17เต้าหู้ปลา.jpg";
//        $food->created_at = "2022-11-04 14:21:38";
//        $food->updated_at= "2022-11-04 14:21:38";
        $food->save();

        $food = new Food();
        $food->name= "เส้นปลา";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_18เส้นปลา.jpg";
//        $food->created_at = "2022-11-04 14:21:39";
//        $food->updated_at= "2022-11-04 14:21:39";
        $food->save();

        $food = new Food();
        $food->name= "เกี๊ยวกุ้งชีส";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_19เกี๊ยวกุ้งชีส.jpg";
//        $food->created_at = "2022-11-04 14:21:40";
//        $food->updated_at= "2022-11-04 14:21:40";
        $food->save();

        $food = new Food();
        $food->name= "เนื้อ Australia";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_1ชุดเนื้อนำเข้า-Australia-สไลซ์.jpg";
//        $food->created_at = "2022-11-04 14:21:40";
//        $food->updated_at= "2022-11-04 14:21:40";
        $food->save();

        $food = new Food();
        $food->name= "ไข่ไก่";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_21ไข่ไก่.jpg";
//        $food->created_at = "2022-11-04 14:21:40";
//        $food->updated_at= "2022-11-04 14:21:40";
        $food->save();

        $food = new Food();
        $food->name= "เนื้อ US";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_2ชุดเนื้อนำเข้า-U.S-สไลซ์.jpg";
//        $food->created_at = "2022-11-04 14:21:40";
//        $food->updated_at= "2022-11-04 14:21:40";
        $food->save();

        $food = new Food();
        $food->name= "หอยแมลงภู่นิวซีแลนด์";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_5หอยแมลงภู่นิวซีแลนด์.jpg";
//        $food->created_at = "2022-11-04 14:21:40";
//        $food->updated_at= "2022-11-04 14:21:40";
        $food->save();

        $food = new Food();
        $food->name= "กุ้งสด";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_6กุ้งสด.jpg";
//        $food->created_at = "2022-11-04 14:21:40";
//        $food->updated_at= "2022-11-04 14:21:40";
        $food->save();

        $food = new Food();
        $food->name= "ปลาหมึกสด";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_7ปลาหมึกสด.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "เนื้อปลาสด";
        $food->type = "meat";
        $food->quantity = 100;
        $food->img_path= "storage/images/meat/01_8เนื้อปลาสด.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "วุ้นเส้น";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_20วุ้นเส้น.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "เห็ดฟาง";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_10เห็ดฟาง.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "ข้าวโพด";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_1ข้าวโพด.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "ฟักทอง";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_2ฟักทองญี่ปุ่น.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "สาหร่ายวากาเมะ";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_3วากาเมะเขียว.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "ผักกาดขาว";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_4ผักกาดขาว.jpg";
//        $food->created_at = "2022-11-04 14:21:41";
//        $food->updated_at= "2022-11-04 14:21:41";
        $food->save();

        $food = new Food();
        $food->name= "กวางตุ้ง";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_6กวางตุ้ง.jpg";
//        $food->created_at = "2022-11-04 14:21:42";
//        $food->updated_at= "2022-11-04 14:21:42";
        $food->save();

        $food = new Food();
        $food->name= "ผักบุ้ง";
        $food->type = "vegetable";
        $food->quantity = 100;
        $food->img_path= "storage/images/vegetable/02_8ผักบุ้ง.jpg";
//        $food->created_at = "2022-11-04 14:21:43";
//        $food->updated_at= "2022-11-04 14:21:43";
        $food->save();

        $food = new Food();
        $food->name= "ขนมจีบ";
        $food->type = "appetizer";
        $food->quantity = 100;
        $food->img_path= "storage/images/appetizer/03_1ชุดขนมจีบ.jpg";
//        $food->created_at = "2022-11-04 14:21:43";
//        $food->updated_at= "2022-11-04 14:21:43";
        $food->save();

        $food = new Food();
        $food->name= "ซาลาเปา";
        $food->type = "appetizer";
        $food->quantity = 100;
        $food->img_path= "storage/images/appetizer/03_2ชุดซาลาเปา.jpg";
//        $food->created_at = "2022-11-04 14:21:43";
//        $food->updated_at= "2022-11-04 14:21:43";
        $food->save();

        $food = new Food();
        $food->name= "ปอเปี๊ยทอด";
        $food->type = "appetizer";
        $food->quantity = 100;
        $food->img_path= "storage/images/appetizer/03_5ปอเปี๊ยะทอด.jpg";
//        $food->created_at = "2022-11-04 14:21:43";
//        $food->updated_at= "2022-11-04 14:21:43";
        $food->save();
    }
}
