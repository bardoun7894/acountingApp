<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sales", function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("stock_id");
            $table->integer("sale_qty");
            $table->float("sale_unit_price");
            $table->unsignedInteger("branch_id");
            $table->unsignedInteger("company_id")->nullable();
            $table->unsignedInteger("category_id");
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("customer_id");
            $table->unsignedInteger("unit_id");
            $table->string("description_ar")->nullable();
            $table->string("description_en")->nullable();
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
        Schema::dropIfExists("sales");
    }
}
