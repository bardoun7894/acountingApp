<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("branches", function (Blueprint $table) {
            $table->id();
            $table->string("branch_name_en")->nullable();
            $table->string("branch_name_ar")->nullable();
            $table->string("address_en")->nullable();
            $table->string("address_ar")->nullable();
            $table->string("phone")->nullable();
            $table
                ->tinyInteger("status")
                ->default(1)
                ->nullable();
            $table->unsignedBigInteger("company_id");
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
        Schema::dropIfExists("branches");
    }
}
