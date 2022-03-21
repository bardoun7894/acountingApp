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
       [ 'unit_code'=>'kg','unit_name_en'=>'kilo','unit_name_ar'=>'كيلو','status'=>1],
       [ 'unit_code'=>'m','unit_name_en'=>'Metre','unit_name_ar'=>'متر','status'=>1],
       [ 'unit_code'=>'l','unit_name_en'=>'litre','unit_name_ar'=>'لتر','status'=>1],
       ];
     Unit::insert($data);
    }
}
