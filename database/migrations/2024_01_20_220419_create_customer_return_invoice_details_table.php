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
            $table->foreignId('customer_return_invoice_id');
            $table->foreignId('user_id')->constrained('users');
//customer invoice details
            $table->foreignId('customer_invoice_id')->constrained('customer_invoices');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('branch_id')->constrained('branches');
           //sale return quantity
            $table->float('sale_return_quantity');
            //sale return unit price
            $table->float('sale_return_unit_price');
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
