<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierReturnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_return_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_invoice_id')->constrained('supplier_invoices');
            $table->string('invoiceno')->constrained('invoices');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('supplier_id')->constrained('suppliers');
            //company_id will be added
            $table->foreignId('company_id')->constrained('companies');
           //branch_id
            $table->foreignId('branch_id')->constrained('branches');
            $table->date('invoice_date');
            // description
            $table->text('description')->nullable();
            //invoice total amount
            $table->float('total_amount');
            $table->boolean('is_returned')->default(0);
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
        Schema::dropIfExists('supplier_return_invoices');
    }
}
