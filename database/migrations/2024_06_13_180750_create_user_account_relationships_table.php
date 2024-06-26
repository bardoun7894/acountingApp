<?php
 use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Support\Facades\Schema;

 class CreateUserAccountRelationshipsTable extends Migration
 {
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::create('user_account_relationships', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('user_id');
             $table->unsignedBigInteger('account_head_id')->nullable();
             $table->unsignedBigInteger('account_control_id')->nullable();
             $table->unsignedBigInteger('account_subcontrol_id')->nullable();
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
         Schema::dropIfExists('user_account_relationships');
     }
 }
