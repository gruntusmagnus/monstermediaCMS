<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('menu_id')
                  ->unsigned();
            $table->integer('parent_id')
                  ->nullable()
                  ->unsigned();
            $table->string('href')
                  ->nullable();
            $table->string('route_name')
                  ->nullable();
            $table->string('route_parameter')
                  ->nullable();
            $table->string('label');
            $table->integer('position')
                  ->unsigned()
                  ->default(0);
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreign('menu_id')
                  ->references('id')
                  ->on('menus')
                  ->onDelete('CASCADE');
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('menu_items')
                  ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menus');
    }
}
