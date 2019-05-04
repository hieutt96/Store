<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_items', function(Blueprint $table) {

            $table->increments('id');
            $table->tinyInteger('services_id', false, true)->length(2);
            $table->string('code', 20);
            $table->string('name', 30)->nullable();
            $table->decimal('discount', 4, 2)->default(0);
            $table->string('amount', 100);
            $table->tinyInteger('stat', false, true)->length(1)->default(1);
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
        Schema::dropIfExists('service_items');
    }
}
