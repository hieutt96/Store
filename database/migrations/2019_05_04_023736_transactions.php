<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table) {

            $table->increments('id');
            $table->tinyInteger('service_items_id', false, true);
            $table->string('param')->length(20);
            $table->integer('amount', false, true)->length(11);
            $table->tinyInteger('quantity', false, true)->default(1);
            $table->string('code', 30)->nullable();
            $table->string('serial')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
