<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("products", function (Blueprint $table) {
            //            id
            //barcode
            //prodcut_no1
            //prodcut_no2
            //prodcut_no3
            //prodcut_no4
            //cat_id               --foreign key from categories table
            //sub_cat_id           --foreign key from sub_categories table
            //supp_id              --foreign key from suppliers table
            //name
            //name_ar
            //unit_id              --foreign key from untis  table
            //cost_price           -- سعر التكلفة
            //sales_price          -- سعر البيع
            //allowtax             -- true or fales           قابل للضريبية ؟
            //taxrat               --نسبة الضريبة
            //allowexprie          -- true or false                قابل للانتهاء؟
            //pic1
            //pic2
            //pic3
            //stat               -- true or false               حالة المنتج
            //
            $table->id();
            $table->string("barcode");
            //            $table->unsignedInteger('category_id');
            $table->unsignedInteger("category_id");
            $table->string("product_no1")->nullable();
            $table->string("product_no2")->nullable();
            $table->string("product_no3")->nullable();
            $table->string("product_no4")->nullable();
            $table->string("product_name_en")->nullable();
            $table->string("product_name_ar")->nullable();
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
        Schema::dropIfExists("products");
    }
}
