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
    ['id'=>0,
        'account_control_name_en'=>'Cash',
        'account_control_name_ar'=>'كاش',
        'account_head_id'=>'9',
        'user_id'=>1]
      , ['id'=>1,
                'account_control_name_en'=>'account receivable'
                ,'account_control_name_ar'=>'حساب العميل',
                'account_head_id'=>'9'
                ,'user_id'=>'1']
   , ['id'=>2,  'account_control_name_en'=>'Note Payable',
                'account_control_name_ar'=>"",
                'account_head_id'=>'10',
                'user_id'=>'1']
   , ['id'=>3,'account_control_name_en'=>'Salary','account_control_name_ar'=>"",'account_head_id'=>'13','user_id'=>'1']
   , ['id'=>4,'account_control_name_en'=>'Sale Income','account_control_name_ar'=>"",'account_head_id'=>'14','user_id'=>'1']
   , ['id'=>5,'account_control_name_en'=>'Land','account_control_name_ar'=>"",'account_head_id'=>'12','user_id'=>'1']
   , ['id'=>6,'account_control_name_en'=>'Bank Transfer','account_control_name_ar'=>"",'account_head_id'=>'12','user_id'=>'1']

  ];
        AccountControl::insert($data);
    }
}
