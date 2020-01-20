
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('accepted_by')->nullable();
            $table->integer('transaction_amount')->nullable()->change();
            $table->integer('bonus')->nullable()->change();
            $table->integer('current_amount')->nullable()->change();
            $table->integer('phone')->nullable();
            $table->unsignedBigInteger('content_id')->nullable();

            $table->foreign('accepted_by')->references('id')->on('users');
            $table->foreign('content_id')->references('id')->on('contents');
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
            $table->dropColumn(['accepted_by', 'content_id', 'phone']);
        });
    }
}
