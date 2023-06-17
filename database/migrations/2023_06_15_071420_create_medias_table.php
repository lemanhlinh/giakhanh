<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('link_video')->nullable();
            $table->tinyInteger('is_home')->default(0)->nullable();
            $table->tinyInteger('active')->default(0)->comment('0: Không hoạt động; 1: Hoạt động');
            $table->tinyInteger('type')->default(0)->comment('0: Hình ảnh; 1: Video');
            $table->integer('ordering')->default(0)->nullable();
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
        Schema::dropIfExists('medias');
    }
}
