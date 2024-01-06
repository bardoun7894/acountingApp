<?php

namespace Database\Seeders;

use App\Models\AccountSetting;
use Illuminate\Database\Seeder;

class AccountSettingSeeder extends Seeder
{

    protected $company_id;
    protected $branch_id;

    public function __construct($company_id = 1, $branch_id = 1)
    {
        $this->company_id = $company_id;
        $this->branch_id = $branch_id;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "account_head_id" => 4,
                "account_control_id" => 43,
                "account_sub_control_id" => 434,
                "account_activity_id" => 6,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 3,
                "account_control_id" => 31,
                "account_sub_control_id" => 311,
                "account_activity_id" => 1,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 4,
                "account_control_id" => 41,
                "account_sub_control_id" => 413,
                "account_activity_id" => 4,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 3,
                "account_control_id" => 31,
                "account_sub_control_id" => 312,
                "account_activity_id" => 2,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 4,
                "account_control_id" => 41,
                "account_sub_control_id" => 411,
                "account_activity_id" => 3,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 4,
                "account_control_id" => 43,
                "account_sub_control_id" => 431,
                "account_activity_id" => 5,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 2,
                "account_control_id" => 21,
                "account_sub_control_id" => 212,
                "account_activity_id" => 8,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 1,
                "account_control_id" => 11,
                "account_sub_control_id" => 112,
                "account_activity_id" => 9,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_head_id" => 1,
                "account_control_id" => 11,
                "account_sub_control_id" => 111,
                "account_activity_id" => 9,
                "branch_id" => $this->branch_id,
                "company_id" => $this->company_id,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
        AccountSetting::insert($data);
    }
}
