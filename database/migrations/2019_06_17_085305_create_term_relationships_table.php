<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_relationships', function (Blueprint $table) {
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('term_taxonomy_id');
            $table->integer('order')->nullable();

            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('term_taxonomy_id')->references('id')->on('term_taxonomy')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_relationships');
    }
}
