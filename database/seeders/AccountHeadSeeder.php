<?php

namespace Database\Seeders;

use App\Models\AccountHead;
use Illuminate\Database\Seeder;

class AccountHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   $data=[
       ['id'=>9, 'user_id'=>1,'account_head_name_en'=>'assets','account_head_name_ar'=>'الأصول','account_head_code'=>''],
       ['id'=>10,'user_id'=>1,'account_head_name_en'=>'liabilities','account_head_name_ar'=>'','account_head_code'=>''],
       ['id'=>11,'user_id'=>1,'account_head_name_en'=>'Equity','account_head_name_ar'=>'','account_head_code'=>''],
       ['id'=>12,'user_id'=>1,'account_head_name_en'=>'Capital','account_head_name_ar'=>'','account_head_code'=>''],
       ['id'=>13,'user_id'=>1,'account_head_name_en'=>'Expenses','account_head_name_ar'=>'','account_head_code'=>''],
       ['id'=>14,'user_id'=>1,'account_head_name_en'=>'Revenue','account_head_name_ar'=>'','account_head_code'=>''],
   ];
   AccountHead::insert($data);

    }
}
