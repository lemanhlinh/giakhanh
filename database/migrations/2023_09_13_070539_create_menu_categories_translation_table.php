<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCategoriesTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_category_id')->unsigned();
            $table->string('name');
            $table->string('lang');
            $table->timestamps();

            $table->foreign('menu_category_id')->references('id')->on('menu_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_categories_translation');
    }
}
