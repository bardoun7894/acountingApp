<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('payment_type_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->string('title_en');
            $table->string('description_en');
            $table->string('title_ar')->nullable();
            $table->string('description_ar')->nullable();
            $table->float('discount')->nullable();
            $table->float('tax')->nullable();
            $table->float('total_amount')->nullable();
            $table->float('sub_total_amount')->nullable();
            $table->float('total_tax_allowed')->nullable();
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
        Schema::dropIfExists('customer_invoices');
    }
}
