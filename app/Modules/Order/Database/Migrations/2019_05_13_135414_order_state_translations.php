<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderStateTranslations extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('order_state_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_state_id')->length(10);
            $table->string('locale', 5)->index();
            $table->string('name',250);

            $table->unique(['order_state_id','locale']);
            $table->foreign('order_state_id')->references('id')->on('order_states')->onDelete('cascade');
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists('order_state_translations');
    }
}