<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     $data=[
       ['id'=>0,'unit_code'=>'sr','name'=>'sr','name_ar'=>'رس','status'=>1],
       ['id'=>1,'unit_code'=>'$','name'=>'Dollar','name_ar'=>'دولار','status'=>1],
       ['id'=>2,'unit_code'=>'LE','name'=>'LE','name_ar'=>'جنيه','status'=>1],
       ['id'=>3,'unit_code'=>'e','name'=>'euro','name_ar'=>'اورو','status'=>1],
       ];
     Unit::insert($data);
    }
}
