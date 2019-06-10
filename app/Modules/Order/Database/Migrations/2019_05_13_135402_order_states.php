<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderStates extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('order_states', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('position');
            $table->timestamps();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists('order_states');
    }
}