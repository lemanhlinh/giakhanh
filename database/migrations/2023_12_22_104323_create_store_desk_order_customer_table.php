<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDeskOrderCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_desk_order_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->integer('table_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('price')->nullable();
            $table->string('product_name')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
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
        Schema::dropIfExists('store_desk_order_customer');
    }
}
