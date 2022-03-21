<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data =[
    ['payment_type_name_en'=>'cash','payment_type_name_ar'=>'كاش','status'=>1],
    ['payment_type_name_en'=>'bank transfer','payment_type_name_ar'=>'تحويل بنكي','status'=>1],
    ['payment_type_name_en'=>'atm','payment_type_name_ar'=>' بطاقة صرافة الي','status'=>1],
        ];
        PaymentType::insert($data);
//        طريقة الدفع ( كاش - تحويل بنكي - بطاقة صرافة الي

    }
}
