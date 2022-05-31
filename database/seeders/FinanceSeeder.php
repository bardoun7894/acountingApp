<?php

namespace Database\Seeders;

use App\Models\FinanceYear;
use DateTime;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user_id)
    {
        $d = new DateTime(); //get current date time
        $data = [
            [
                "user_id" => $user_id,
                "financial_year" => Date("Y") - 1 . "-" . Date("Y"), //get current date time
                "isActive" => 1, //is active
                "startDate" => $d->format("Y/m/d"), //start date
                "endDate" => $d->format("Y/m/d"), //end date
                "created_at" => $d->format("Y/m/d H:i:s"), //created at
                "updated_at" => $d->format("Y/m/d H:i:s"), //updated at
            ],
        ];
        FinanceYear::insert($data);
    }
}
