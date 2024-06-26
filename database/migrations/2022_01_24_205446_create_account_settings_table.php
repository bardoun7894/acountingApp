<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("account_settings", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("account_head_id");
            $table->unsignedBigInteger("account_control_id");
            $table->unsignedBigInteger("account_sub_control_id");
            $table->unsignedBigInteger("account_activity_id");
            $table->unsignedBigInteger("company_id");
            $table->unsignedBigInteger("branch_id");
            // $table->unsignedBigInteger("user_id");
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
        Schema::dropIfExists("account_settings");
    }
}
