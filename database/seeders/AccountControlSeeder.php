<?php

namespace Database\Seeders;

use App\Models\AccountControl;
use Illuminate\Database\Seeder;

class AccountControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[

//            account_head
        [ 'id'=>1,'account_code'=>'11','account_control_name_en'=>'Fixed Assets',
        'account_control_name_ar'=>'الأصول الثابتة','account_head_id'=>'1','user_id'=>1 ] ,
        [ 'id'=>2,'account_code'=>'12',
         'account_control_name_en'=>'Inventory','account_control_name_ar'=>'المخزون',
          'account_head_id'=>'1','user_id'=>1 ] ,
        [ 'id'=>3,'account_code'=>'13',
         'account_control_name_en'=>'Debitors','account_control_name_ar'=>'المدينون',
         'account_head_id'=>'1','user_id'=>1  ] ,
        [ 'id'=>4,'account_code'=>'14',
            'account_control_name_en'=>'Current Assets','account_control_name_ar'=>'الاصولة المتداولة',
            'account_head_id'=>'1','user_id'=>1 ] ,

        ];

        AccountControl::insert($data);
    }
}
