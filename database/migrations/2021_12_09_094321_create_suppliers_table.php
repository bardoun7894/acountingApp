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
            $table->string('supplier_name_en')->nullable();
            $table->string('supplier_name_ar')->nullable();
            $table->string('supplier_type')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
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
