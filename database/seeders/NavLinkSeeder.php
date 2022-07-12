<?php

namespace Database\Seeders;

use App\Models\NavLink;
use Illuminate\Database\Seeder;

class NavLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannersRecords = [
            ["id" => 1, "link_name" => "Home"],
            ["id" => 2, "link_name" => "Product"],
            ["id" => 3, "link_name" => "Categories"],
        ];
        NavLink::insert($bannersRecords);
    }
}
