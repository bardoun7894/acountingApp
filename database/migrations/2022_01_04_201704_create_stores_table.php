<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("stores", function (Blueprint $table) {
            $table->id();
            $table->string("store_name_en")->nullable();
            $table->string("store_name_ar")->nullable();
            $table->unsignedInteger("branch_id")->nullable();
            $table->unsignedInteger("company_id")->nullable();
            $table->unsignedInteger("user_id")->nullable();
            $table->tinyInteger("status")->default(0);
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
        Schema::dropIfExists("stores");
    }
}
