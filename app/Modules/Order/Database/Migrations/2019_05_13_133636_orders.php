<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',16);
            $table->unsignedInteger('user_id')->length(10);
            $table->unsignedInteger('payment_id')->length(10);
            $table->unsignedInteger('table_number')->length(10);

            $table->decimal('total_price',12,6);
            $table->decimal('total_tax',12,6);
            $table->decimal('total_sum',12,6);
            $table->boolean('completed');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            //$table->foreign('payment_id')->references('id')->on('payments')->onDelete('restrict');
            //todo:: po přidání platebních modulů

        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}