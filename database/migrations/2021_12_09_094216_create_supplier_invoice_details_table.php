<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('purchase_quantity');
            $table->float('purchase_unit_price');

            $table->timestamps();

            // $table->foreign('supplier_invoice_id')->references('id')->on('supplier_invoices')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('stocks')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_invoice_details');
    }
}
