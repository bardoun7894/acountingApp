<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierReturnInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_return_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_return_invoice_id');
            $table->foreignId('supplier_invoice_detail_id');
            //supplier invoice id
            $table->foreignId('supplier_invoice_id')->constrained('supplier_invoices');
            //stock_id
            $table->foreignId('stock_id')->constrained('stocks');
            //purchase return quantity
            $table->double('purchase_return_quantity');
            // purchase return unit price
            $table->double('purchase_return_unit_price');
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
        Schema::dropIfExists('supplier_return_invoice_details');
    }
}
