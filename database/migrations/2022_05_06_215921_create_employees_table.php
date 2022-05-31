<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("employees", function (Blueprint $table) {
            /* 
            |--------------------------------------------------------------------------
            | Employee Table Fields
            |--------------------------------------------------------------------------
            */
            $table->id();
            $table->string("employee_name_en")->nullable();
            $table->string("employee_name_ar")->nullable();
            $table->string("employee_email")->nullable();
            $table->string("employee_photo")->nullable();
            $table->string("address")->nullable();
            $table->string("description")->nullable();
            $table->string("monthly_salary")->nullable();
            $table->string("designation")->nullable();
            $table->string("cnic")->nullable();
            $table->string("employee_contact_number")->nullable();
            $table->unsignedBigInteger("branch_id")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("company_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("employees");
    }
}
