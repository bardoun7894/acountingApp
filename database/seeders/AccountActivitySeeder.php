<?php

namespace Database\Seeders;

use App\Models\AccountActivity;
use Illuminate\Database\Seeder;

class AccountActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data=[
  ['id'=>1, 'account_activity_name_en'=>'Sale','account_activity_name_ar'=>'بيع'],
  ['id'=>2, 'account_activity_name_en'=>'Sale Return','account_activity_name_ar'=>'مردودات المبيعات'],
  ['id'=>3, 'account_activity_name_en'=>'Purchase Product','account_activity_name_ar'=>'شراء المنتج'],
  ['id'=>4, 'account_activity_name_en'=>'Purchase Return','account_activity_name_ar'=>'مردودات المشتريات'],
  ['id'=>5, 'account_activity_name_en'=>'Salary','account_activity_name_ar'=>'الراتب'],
  ['id'=>6, 'account_activity_name_en'=>'Expenses','account_activity_name_ar'=>'المصروفات'],
  ['id'=>7, 'account_activity_name_en'=>'Cost Of Good Sold','account_activity_name_ar'=>'صافي المبيعات'],
  ['id'=>8, 'account_activity_name_en'=>'Purchase Payment Pending','account_activity_name_ar'=>'في انتظار الدفع ثمن المشتريات'],
  ['id'=>9, 'account_activity_name_en'=>'Purchase Payment Succeed','account_activity_name_ar'=>' تم دفع ثمن المشتريات بنجاح'],

       ];

       AccountActivity::insert($data);
    }
}
