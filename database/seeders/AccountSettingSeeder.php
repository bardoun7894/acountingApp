<?php

namespace Database\Seeders;

use App\Models\AccountSetting;
use Illuminate\Database\Seeder;

class AccountSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($branch_id, $company_id)
    {
        $data = [
            [
                "id" => 1,
                "account_head_id" => 4,
                "account_control_id" => 10,
                "account_sub_control_id" => 39,
                "account_activity_id" => 6,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 2,
                "account_head_id" => 3,
                "account_control_id" => 6,
                "account_sub_control_id" => 25,
                "account_activity_id" => 1,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 3,
                "account_head_id" => 4,
                "account_control_id" => 8,
                "account_sub_control_id" => 31,
                "account_activity_id" => 4,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 4,
                "account_head_id" => 3,
                "account_control_id" => 6,
                "account_sub_control_id" => 24,
                "account_activity_id" => 2,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 6,
                "account_head_id" => 4,
                "account_control_id" => 8,
                "account_sub_control_id" => 29,
                "account_activity_id" => 3,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 7,
                "account_head_id" => 4,
                "account_control_id" => 10,
                "account_sub_control_id" => 36,
                "account_activity_id" => 5,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 8,
                "account_head_id" => 2,
                "account_control_id" => 4,
                "account_sub_control_id" => 18,
                "account_activity_id" => 8,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 9,
                "account_head_id" => 1,
                "account_control_id" => 1,
                "account_sub_control_id" => 2,
                "account_activity_id" => 9,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 10,
                "account_head_id" => 1,
                "account_control_id" => 1,
                "account_sub_control_id" => 1,
                "account_activity_id" => 9,
                "branch_id" => $branch_id,
                "company_id" => $company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
        AccountSetting::insert($data);
    }
}
