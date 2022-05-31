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
    public function run($user_id, $company_id, $branch_id)
    {
        $data = [
            [
                "id" => 1,
                "user_id" => $user_id,
                "company_id" => $company_id,
                "branch_id" => $branch_id,
                "account_head_name_en" => "assets",
                "account_head_name_ar" => "الأصول",
                "account_code" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 2,
                "user_id" => $user_id,
                "company_id" => $company_id,
                "branch_id" => $branch_id,

                "account_head_name_en" => "liabilities",
                "account_head_name_ar" => "الخصوم(المطلوبات)",
                "account_code" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 3,
                "user_id" => $user_id,
                "company_id" => $company_id,
                "branch_id" => $branch_id,

                "account_head_name_en" => "Revenue",
                "account_head_name_ar" => "الايرادات",
                "account_code" => "3",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 4,
                "user_id" => $user_id,

                "company_id" => $company_id,
                "branch_id" => $branch_id,

                "account_head_name_en" => "Expenses",
                "account_head_name_ar" => "المصروفات",
                "account_code" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
        AccountHead::insert($data);
    }
}
