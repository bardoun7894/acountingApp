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
       ['id'=>9, 'user_id'=>1,'account_head_name_en'=>'assets','account_head_name_ar'=>'الأصول','account_head_code'=>'1'],
       ['id'=>10,'user_id'=>1,'account_head_name_en'=>'liabilities','account_head_name_ar'=>'','account_head_code'=>'2'],
       ['id'=>13,'user_id'=>1,'account_head_name_en'=>'Expenses','account_head_name_ar'=>'', 'account_head_code'=>'3'],
       ['id'=>14,'user_id'=>1,'account_head_name_en'=>'Revenue','account_head_name_ar'=>'', 'account_head_code'=>'4'],
   ];
   AccountHead::insert($data);

    }
}
