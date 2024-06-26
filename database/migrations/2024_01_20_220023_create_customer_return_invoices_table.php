<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerReturnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_return_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_invoice_id');
            $table->string('invoiceno')->nullable();
            $table->bigInteger('user_id') ;
            $table->bigInteger('customer_id') ;
            //company_id
            $table->bigInteger('company_id') ;
            //branch_id
            $table->bigInteger('branch_id') ;
            $table->date('invoice_date');
            // description
            $table->text('description');
            //invoice total amount
            $table->float('total_amount');

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
        Schema::dropIfExists('customer_return_invoices');
    }
}
