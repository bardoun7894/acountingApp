<?php

namespace Database\Seeders;

use App\Models\AccountDetail;
use Illuminate\Database\Seeder;

class AccountDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "account_sub_control_id" => 1,
                "account_detail_name_en" => "Cash",
                "account_detail_name_ar" => "نقدية",
                "account_code" => "1111"
            ],
            [
                "account_sub_control_id" => 1,
                "account_detail_name_en" => "Bank",
                "account_detail_name_ar" => "بنكية",
                "account_code" => "1112"
            ],
            [
                "account_sub_control_id" => 1,
                "account_detail_name_en" => "Credit",
                "account_detail_name_ar" => "ائتمانية",
                "account_code" => "1113"
            ],
            [
                "account_sub_control_id" => 1,
                "account_detail_name_en" => "Debit",
                "account_detail_name_ar" => "مدينة",
                "account_code" => "1114"

            ],
            [
                "account_sub_control_id" => 1,
                "account_detail_name_en" => "Other",
                "account_detail_name_ar" => "اخرى",
                "account_code" => "1115"

            ],
            [
                "account_sub_control_id" => 2,
                "account_code" => "1121",
                "account_detail_name_en" => "Sales",
                "account_detail_name_ar" => "بيع",

                ],
            [
                "account_sub_control_id" => 2,
                "account_code" => "1122",
                "account_detail_name_en" => "Purchase",
                "account_detail_name_ar" => "شراء",
             ],

        ];
        AccountDetail::insert($data);



    }
}
