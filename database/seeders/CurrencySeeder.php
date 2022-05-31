<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //            $table->string('currency_name_en')->nullable();
        //            $table->string('currency_name_ar')->nullable();
        //            $table->string('currency_code')->nullable();
        //            $table->string('currency_symbol')->nullable();
        //            $table->tinyInteger('status')->default(0);
        $data = [
            [
                "currency_name_en" => "Dollar",
                "currency_name_ar" => "دولار",
                "currency_code" => "USD",
                "currency_symbol" => '$',
                "status" => 0,
            ],
            [
                "currency_name_en" => "Pound",
                "currency_name_ar" => "جنيه",
                "currency_code" => "LE",
                "currency_symbol" => "£",
                "status" => 0,
            ],
            [
                "currency_name_en" => "Rials",
                "currency_name_ar" => "ريال",
                "currency_code" => "IRR",
                "currency_symbol" => "رس",
                "status" => 1,
            ],
        ];
        Currency::insert($data);
    }
}
