<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $table->unsignedBigInteger("user_type_id")->default(1);
        // $table->string("full_name_en")->nullable();
        // $table->string("full_name_ar")->nullable();
        // $table->string("username")->unique();
        // $table->string("email")->unique();
        // $table->string("address_en")->nullable();
        // $table->string("address_ar")->nullable();
        // $table->string("contact_number")->nullable();
        // $table->timestamp("email_verified_at")->nullable();
        // $table->string("password");
        // $table->string("image")->nullable();
        // $table->unsignedInteger("branch_id")->nullable();
        // $table->unsignedInteger("store_id")->nullable();
        // $table->unsignedInteger("company_id")->nullable();
        $data = [
            [
                "user_type_id" => 1,
                "full_name_en" => "ادمن",
                "full_name_ar" => "Super Admin",
                "username" => "superadmin",
                "email" => "admin@admin.com",
                "email_verified_at" => now(),
                "password" => bcrypt("12345678"),
                "image" => "Super Admin",
                "branch_id" => 1,
                "company_id" => 1,
                "isActive" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ]
             ];

        User::insert($data);
    }
}
