<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_cart_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('stock_id');
            $table->integer('purchase_qty');
            $table->float('purchase_unit_price');
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('unit_id');
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();

            $table->date('expiry_date');
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
        Schema::dropIfExists('purchase_cart_details');
    }
}
