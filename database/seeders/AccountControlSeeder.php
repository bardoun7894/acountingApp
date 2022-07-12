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
    public function run($user_id, $branch_id, $company_id)
    {
        $data = [
            //            account_head 1

            [
                "account_code" => "11",
                "account_control_name_en" => "Current Assets",
                "account_control_name_ar" => "الأصول المتداولة",
                "account_head_id" => "1",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "12",
                "account_control_name_en" => "Fixed Assets",
                "account_control_name_ar" => "الأصول الثابتة",
                "account_head_id" => "1",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "13",
                "account_control_name_en" => "intangible Assets",
                "account_control_name_ar" => "الأصول الغير ملموسة",
                "account_head_id" => "1",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],

            //liabilities
            [
                "account_code" => "21",
                "account_control_name_en" => "Current Liabilities",
                "account_control_name_ar" => "الالتزامات المتداولة",
                "account_head_id" => "2",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "22",
                "account_control_name_en" => "Fixed Liabilities",
                "account_control_name_ar" => "الالتزامات الثابتة",
                "account_head_id" => "2",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],

            //            ايرادات المبيعات Sales Revenues 31
            //ايرادات أخرى Other Sales 32
            [
                "account_code" => "31",
                "account_control_name_en" => "Sales Revenues",
                "account_control_name_ar" => "ايرادات المبيعات",
                "account_head_id" => "3",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "account_code" => "32",
                "account_control_name_en" => "Other Revenues",
                "account_control_name_ar" => "ايرادات أخرى",
                "account_head_id" => "3",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],

            // صافي المبيعات Cost Of Good Sold 41
            //	المشتريات Purchases   411
            //	المشتريات Purchases  Expenses  412
            //	مردودات مشتريات Purchases Returns   413
            //	مسموحات مشتريات   Purchases Discount   414
            //   	مصاريف البيع والتسويق sale and marketing expenses 42
            //	      مصاريف البيع  sale expenses 421
            //	      عمولات البيع    sale commissions 422
            //	   دعاية واعلان   Advertising    423
            //    مصاريف ادارية وعمومية   administrative expenses 43
            //	الأجور Payroll 431
            //	الايجار Rents 432
            //	كهرباء Electricity 433
            //	الصيانة Maintenance 434
            [
                "account_code" => "41",
                "account_control_name_en" => "Cost Of Good Sold",
                "account_control_name_ar" => "صافي المبيعات",
                "account_head_id" => "4",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "42",
                "account_control_name_en" => "sale and marketing expenses",
                "account_control_name_ar" => "مصاريف البيع والتسويق",
                "account_head_id" => "4",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "43",
                "account_control_name_en" => "administrative expenses",
                "account_control_name_ar" => "مصاريف ادارية وعمومية",
                "account_head_id" => "4",
                "user_id" => $user_id,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];

        AccountControl::insert($data);
    }
}
