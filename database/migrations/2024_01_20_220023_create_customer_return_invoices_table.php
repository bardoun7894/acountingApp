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
            $table->foreignId('customer_invoice_id');
            $table->string('invoiceno');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('customers');
            //company_id
            $table->foreignId('company_id')->constrained('companies');
            //branch_id
            $table->foreignId('branch_id')->constrained('branches');
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
