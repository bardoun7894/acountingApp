<?php

namespace Database\Seeders;

use App\Models\FinanceYear;
use Illuminate\Database\Seeder;
use DateTime;

class FinanceSeeder extends Seeder
{
    protected $user_id;

    public function __construct($user_id = 1) {
        $this->user_id = $user_id;
    }

    public function run()
    {
        $currentYear = date("Y");
        $previousYear = $currentYear - 1;
        $startDate = DateTime::createFromFormat('Y-m-d', "$previousYear-04-01");
        $endDate = DateTime::createFromFormat('Y-m-d', "$currentYear-03-31");

        $data = [
            [
                "user_id" => $this->user_id,
                "financial_year" => "$previousYear-$currentYear",
                "isActive" => 1,
                "startDate" => $startDate->format("Y-m-d"),
                "endDate" => $endDate->format("Y-m-d"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];

        FinanceYear::updateOrCreate(
            ['user_id' => $this->user_id, 'financial_year' => "$previousYear-$currentYear"],
            $data[0]
        );
    }
}
