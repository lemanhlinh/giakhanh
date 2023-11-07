<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesCategoriesTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_categories_translation', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->tinyInteger('active')->default(0)->comment('0: Không hoạt động; 1: Hoạt động');
            $table->tinyInteger('type')->default(1)->comment('0: Danh sach tin tức; 1: Danh sách ưu đãi');
            $table->timestamps();
            $table->string('lang');
            $table->integer('article_category_id')->unsigned();

            $table->foreign('article_category_id')->references('id')->on('articles_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_categories_translation');
    }
}
