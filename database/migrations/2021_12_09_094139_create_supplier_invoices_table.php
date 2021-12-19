<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_no');
            $table->integer('supplier_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('title');
            $table->string('description_en');
            $table->string('description_ar');
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
        Schema::dropIfExists('supplier_invoices');
    }
}
