<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderProducts extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->length(10);
            $table->unsignedInteger('order_id')->length(10);
            $table->unsignedInteger('order_state_id')->length(10);
            $table->unsignedInteger('quantity');

            $table->decimal('unit_price',12,6);
            $table->decimal('unit_tax',12,6);

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict');
            $table->foreign('order_state_id')->references('id')->on('order_states')->onDelete('restrict');
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}