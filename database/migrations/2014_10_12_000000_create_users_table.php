<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users' , function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_type_id')->default(1);
            $table->string('full_name_en')->nullable();;
            $table->string('full_name_ar')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
