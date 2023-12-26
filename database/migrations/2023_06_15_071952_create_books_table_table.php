<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('table_id')->unsigned()->nullable();
            $table->date('book_time');
            $table->string('book_hour');
            $table->integer('number_customers');
            $table->text('note')->nullable();
            $table->text('admin_note')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('books_table');
    }
}
