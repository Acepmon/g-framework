<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_method');
            $table->string('transaction_type', 12);
            $table->integer('transaction_amount');
            $table->string('transaction_usage', 20);
            $table->integer('bonus');
            $table->integer('current_amount');
            $table->string('status', 20);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_method')->references('id')->on('payment_methods');
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
        Schema::dropIfExists('payment_transactions');
    }
}
