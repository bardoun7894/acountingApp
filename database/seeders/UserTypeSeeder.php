<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $data=[
        [ 'id'=>1,'user_type_en'=>"admin",'user_type_ar'=>"أدمن"],
        [ 'id'=>2,'user_type_en'=>"user",'user_type_ar'=>"مستخدم"],
    ];

    UserType::insert($data);

    }
}
