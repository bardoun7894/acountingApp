<?php

namespace Database\Seeders;

use App\Models\SellType;
use Illuminate\Database\Seeder;

class SellTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data =[
            ['sell_type_name_en'=>'cash','sell_type_name_ar'=>'نقد','status'=>1],
            ['sell_type_name_en'=>'short sale','sell_type_name_ar'=>'البيع الاجل','status'=>1],
        ];
        SellType::insert($data);
//     نقد - اجل
    }
}
