<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
        $table->id();
        $table->integer('category_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->integer('quantity');
        $table->string('product_name_en')->nullable();
        $table->string('description_en')->nullable();
        $table->string('product_name_ar')->nullable();
        $table->string('description_ar')->nullable();
        $table->float('sale_unit_price');
        $table->float('current_purchase_unit_price');
        $table->date('expiry_date');
        $table->date('manufacture_date');
        $table->integer('stock_trash_hold_qty');
        $table->boolean('isdeleted')->default(false);
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
        Schema::dropIfExists('stocks');
    }
}
