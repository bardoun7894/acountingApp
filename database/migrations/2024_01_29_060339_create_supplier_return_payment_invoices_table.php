<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierReturnPaymentInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_return_payment_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('supplier_invoice_id');
            $table->integer('supplier_return_id');
            $table->integer('supplier_return_invoice_id');
            $table->string('invoice_no');
            $table->date('date');
            $table->float('total_amount');
            $table->float('payment_amount');
            $table->float('remaining_balance');
            //branch
            $table->integer('branch_id');
            $table->integer('user_id');
            $table->integer('company_id');

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
        Schema::dropIfExists('supplier_return_payment_invoices');
    }
}
