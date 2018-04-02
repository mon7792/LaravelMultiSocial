<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('collect_user_id');
            $table->integer('staff_incharge_collect_id');
            $table->integer('staff_incharge_return_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('return_date');
            $table->string('booking_reason');
            $table->string('booking_status');
            $table->string('reject_comment');
            $table->string('return_comment');
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
        Schema::dropIfExists('transactions');
    }
}
