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
            $table->string('invoice_no');
            $table->integer('supplier_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->dateTime('invoice_date');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->double('total_amount');
            $table->unsignedInteger('branch_id')->nullable();
            $table->double('sub_total_amount')->nullable();
            $table->double('tax')->nullable();
            $table->double('total_tax_allow')->nullable();
            $table->double('discount')->nullable();
            $table->unsignedInteger('store_id')->nullable();


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
