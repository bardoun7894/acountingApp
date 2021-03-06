<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("finance_years", function (Blueprint $table) {
            $table->id();
            $table->string("financial_year");
            $table->unsignedInteger("user_id")->nullable();
            $table->tinyInteger("isActive")->default(1);
            $table->date("startDate");
            $table->date("endDate");
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
        Schema::dropIfExists("finance_years");
    }
}
