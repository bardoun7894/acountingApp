<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("account_heads", function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->integer("company_id")->unsigned();
            $table->integer("branch_id")->unsigned();
            $table->string("account_head_name_en")->nullable();
            $table->string("account_head_name_ar")->nullable();
            $table->string("account_code")->nullable();
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
        Schema::dropIfExists("account_heads");
    }
}
