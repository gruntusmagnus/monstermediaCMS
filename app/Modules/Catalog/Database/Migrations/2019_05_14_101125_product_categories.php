<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductCategories extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->length(10);
            $table->unsignedInteger('category_id')->length(10);

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->primary(['product_id', 'category_id']);
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}