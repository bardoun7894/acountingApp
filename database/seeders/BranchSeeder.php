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

     ['branch_name_en'=>'saudi branch','branch_name_ar'=>'فرع السعودية','status'=>1],
     ['branch_name_en'=>'morroco branch','branch_name_ar'=>'فرع المغرب','status'=>1],
        ];
 Branch::insert($data);

    }
}
