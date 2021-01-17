<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentTransaction2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->foreign('accepted_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropForeign(['accepted_by']);
            $table->dropForeign(['content_id']);
            $table->dropColumn(['accepted_by', 'content_id']);

        });
    }
}
