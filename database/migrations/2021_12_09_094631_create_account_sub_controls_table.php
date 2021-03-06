<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSubControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("account_sub_controls", function (Blueprint $table) {
            $table->id();
            $table->string("account_code")->nullable();
            $table->integer("user_id")->unsigned();
            $table->integer("account_control_id")->unsigned();
            $table->integer("account_head_id")->unsigned();
            $table->string("account_sub_control_name_en")->nullable();
            $table->string("account_sub_control_name_ar")->nullable();
            $table->unsignedBigInteger("company_id");
            $table->unsignedBigInteger("branch_id");
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
        Schema::dropIfExists("account_sub_controls");
    }
}
