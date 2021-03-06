<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("transactions", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("financial_year_id");
            $table->unsignedBigInteger("account_head_id");
            $table->unsignedBigInteger("account_control_id");
            $table->unsignedBigInteger("account_sub_control_id");
            $table->string("invoice_number");
            $table->unsignedInteger("user_id")->nullable();
            $table->unsignedInteger("branch_id")->nullable();
            $table->unsignedInteger("company_id")->nullable();
            $table->float("credit");
            $table->float("debit");
            $table->date("transaction_date");
            $table->string("transaction_title_en");
            $table->string("transaction_title_ar");
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
        Schema::dropIfExists("transactions");
    }
}
