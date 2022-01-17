<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
//            $table->id();
            $table->string('store_name_en')->nullable();
            $table->string('store_name_ar')->nullable();
            $table->string('sale_cash_acc_no')->nullable();
            $table->string('sale_debit_acc_no')->nullable();
            $table->string('buy_cash_acc_no')->nullable();
            $table->string('buy_debit_acc_no')->nullable();
            $table->string('Rsale_acc_no')->nullable();
            $table->string('Rbuy_acc_no')->nullable();
            $table->string('store_start_acc_no')->nullable();
            $table->string('INVENTORY_acc_no')->nullable();
            $table->string('CAPITAL_acc_no')->nullable();
            $table->string('disc_cr_acc_no')->nullable();
            $table->string('disc_de_acc_no')->nullable();
            $table->tinyInteger('status')->default(0);
//            create stores table
//id
//name
//name_ar
//sale_cash_acc_no   --foreign key from accounts table  حساب المبيعات النقدية
//sale_debit_acc_no  --foreign key from accounts table حساب المبيعات الاجلة
//buy_cash_acc_no    --foreign key from accounts table حساب المشتريات النقدية
//buy_debit_acc_no   --foreign key from accounts table حساب  المشتريات الاجلة
//Rsale_acc_no       --foreign key from accounts table حساب مرتجع المبيعات
//Rbuy_acc_no        --foreign key from accounts tableحساب مرتجع المشتريات
//store_start_acc_no  --foreign key from accounts table حساب مخزون بداية الفترة
//INVENTORY_acc_no   --foreign key from accounts table حساب تسويات الجرد
//CAPITAL_acc_no     --foreign key from accounts table حساب راس المال
//disc_cr_acc_no     --foreign key from accounts table حساب الخصم المكتسب
//disc_de_acc_no     --foreign key from accounts table حساب الخصم الممنوح
//stat

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
        Schema::dropIfExists('stores');
    }
}
