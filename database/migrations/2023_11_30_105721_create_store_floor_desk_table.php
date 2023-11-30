<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreFloorDeskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_floor_desk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('number_desk');
            $table->integer('store_floor_id')->unsigned()->nullable();
            $table->tinyInteger('type')->default(0)->comment('0: Bàn mặc định; 1: Bàn Vip');
            $table->tinyInteger('active')->default(0)->comment('0: Không hoạt động; 1: Hoạt động');
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
        Schema::dropIfExists('store_floor_desk');
    }
}
