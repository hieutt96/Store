<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Logs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('transactions_id', false, true)->nullable();
            $table->string('resCode')->nullable();
            $table->longText('dataReq')->nullable();
            $table->longText('dataRes')->nullable();
            $table->string('param')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
