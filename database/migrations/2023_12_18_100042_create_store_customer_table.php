<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->integer('book_table_id')->unsigned()->nullable();
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('table_id')->unsigned()->nullable();
            $table->date('book_time')->nullable()->comment('Giờ đặt trước');
            $table->string('book_hour')->nullable()->comment('Ngày đặt trước');
            $table->dateTime('time_come')->nullable()->comment('Ngày giờ đến thực tế');
            $table->integer('number_customers')->nullable();
            $table->integer('total_price')->nullable();
            $table->text('note')->nullable();
            $table->text('admin_note')->nullable();
            $table->tinyInteger('status')->nullable()->default(1)->comment('1: Đợi xử lý; 2: Thành công; 3: Hủy');
            $table->tinyInteger('type')->nullable()->default(1)->comment('1: Web; 2: Store');
            $table->tinyInteger('use_table')->nullable()->default(2)->comment('1: Đang dùng; 2: Chưa dùng');
            $table->tinyInteger('type_payment')->nullable()->default(2)->comment('1: Đã thanh toán; 2: Chưa thanh toán');
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
        Schema::dropIfExists('store_customer');
    }
}
