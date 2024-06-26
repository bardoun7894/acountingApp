<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerReturnInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_return_invoice_details', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('customer_return_invoice_id');
            $table->unsignedBigInteger('customer_invoice_detail_id');
            $table->unsignedBigInteger('customer_invoice_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('branch_id');
            $table->integer('sale_return_quantity');
            $table->decimal('sale_return_unit_price', 8, 2);
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
        Schema::dropIfExists('customer_return_invoice_details');
    }
}
