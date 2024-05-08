<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountDetailsTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('account_details', function (Blueprint $table) {
            $table->id();
            //account sub control id
            $table->foreignId('account_sub_control_id')->constrained('account_sub_controls');
            // account_detail_name_en VARCHAR(255),
            $table->string('account_detail_name_en');
            // account_detail_name_ar VARCHAR(255),
            $table->string('account_detail_name_ar');
            //  account_code VARCHAR(255) NOT NULL,
            $table->string('account_code');
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
        Schema::dropIfExists('account_details');
    }
}
