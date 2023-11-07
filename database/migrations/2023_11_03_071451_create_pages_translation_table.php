<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_translation', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image_title')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('is_home')->default(0)->nullable();
            $table->tinyInteger('active')->default(0)->comment('0: Không hoạt động; 1: Hoạt động');
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->string('lang');
            $table->integer('page_id')->unsigned();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_translation');
    }
}
