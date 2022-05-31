<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("customer_payments", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("customer_id")->unsigned();
            $table->bigInteger("customer_invoice_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->integer("invoice_number");
            $table->float("paid_amount");
            $table->float("total_amount");
            $table->float("remaining_balance");
            $table->unsignedBigInteger("company_id")->nullable();
            $table->unsignedBigInteger("branch_id")->nullable();
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
        Schema::dropIfExists("customer_payments");
    }
}
