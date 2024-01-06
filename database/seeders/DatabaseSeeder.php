<?php

namespace Database\Seeders;

use App\Models\AccountActivity;
use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\Currency;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create();
        // $this->call(UserTypeSeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(CurrencySeeder::class);
        // $this->call(AccountHeadSeeder::class);
        // $this->call(AccountControlSeeder::class);
        // $this->call(AccountActivitySeeder::class);
        // $this->call(AccountSettingSeeder::class);
        // $this->call(UnitSeeder::class);
           $this->call(NavLinkSeeder::class);
        // $this->call(AccountSubControlSeeder::class);
        // $this->call(PaymentTypeSeeder::class);
        // $this->call(SellTypeSeeder::class);
        // $this->call(FinanceSeeder::class);

    }
}
