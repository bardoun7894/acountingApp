<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SupplierPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('supplier_payment', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('supplier_id');
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('payment_id');
          $table->unsignedBigInteger('supplier_invoice_id');
          $table->string('invoice_no');
          $table->float('payment_amount');
          $table->float('total_amount');
          $table->float('remaining_balance'); 
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
        //
    }
}
