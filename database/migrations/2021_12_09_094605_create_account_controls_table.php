<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("account_controls", function (Blueprint $table) {
            $table->id();
            $table->string("account_code")->nullable();
            $table->string("account_control_name_en")->nullable();
            $table->string("account_control_name_ar")->nullable();
            $table->integer("account_head_id");
            $table->integer("user_id")->unsigned();
            $table->integer("company_id")->unsigned();
            $table->integer("branch_id")->unsigned();
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
        Schema::dropIfExists("account_controls");
    }
}
