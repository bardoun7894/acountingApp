<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 $data =[
     'branch_name_en'=>'saudi branch'
 ];
 Branch::insert($data);

    }
}
