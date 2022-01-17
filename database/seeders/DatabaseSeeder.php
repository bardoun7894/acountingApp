<?php

namespace Database\Seeders;

use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\User;
use Illuminate\Database\Seeder;
 ;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // \App\Models\User::factory(10)->create();
//       $this->call(UserTypeSeeder::class );
       $this->call(UnitSeeder::class );
//       $this->call(AccountControlSeeder::class );
//       $this->call(UserTableSeeder::class );
     }
}
