<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('name_ar')->nullable();
            $table->tinyInteger('status')->default(0);
//            acc_no   --foreign key from accounts table
//multi_cur--  boolean تعدد العملات
//cur_id --foreign key from currency table

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
        Schema::dropIfExists('boxes');
    }
}
