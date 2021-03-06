<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("categories", function (Blueprint $table) {
            $table->id();
            $table->integer("branch_id")->unsigned();
            $table
                ->integer("parent_id")
                ->unsigned()
                ->nullable();
            $table
                ->integer("store_id")
                ->unsigned()
                ->nullable();
            $table->unsignedInteger("user_id");
            $table->string("category_name_en")->nullable();
            $table->string("category_name_ar")->nullable();
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
        Schema::dropIfExists("categories");
    }
}
