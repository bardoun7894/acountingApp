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
            $table->string("account_code")->unique();
            $table->string("account_control_name_en")->nullable();
            $table->string("account_control_name_ar")->nullable();
            $table->foreignId("account_head_id")->constrained()->onDelete('cascade');
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
