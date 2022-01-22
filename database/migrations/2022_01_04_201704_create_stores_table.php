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
        Schema::create('stores', function (Blueprint $table) {
           $table->id();
            $table->string('store_name_en')->nullable();
            $table->string('store_name_ar')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->string('sale_cash_acc_no')->nullable();
            $table->string('sale_debit_acc_no')->nullable();
            $table->string('buy_cash_acc_no')->nullable();
            $table->string('buy_debit_acc_no')->nullable();
            $table->string('Rsale_acc_no')->nullable();
            $table->string('Rbuy_acc_no')->nullable();
            $table->string('store_start_acc_no')->nullable();
            $table->string('INVENTORY_acc_no')->nullable();
            $table->string('CAPITAL_acc_no')->nullable();
            $table->string('disc_cr_acc_no')->nullable();
            $table->string('disc_de_acc_no')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('stores');
    }
}
