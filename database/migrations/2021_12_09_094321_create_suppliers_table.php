<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address_en');
            $table->string('address_ar');
            $table->string('city_en');
            $table->string('city_ar');
            $table->string('state_en');
            $table->string('state_ar');
            $table->string('zip');
            $table->string('country_en');
            $table->string('country_ar');
            $table->string('website');

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
        Schema::dropIfExists('suppliers');
    }
}
