<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthenticablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authenticables', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('authenticable_id')->unsigned()->index();
            $table->string('authenticable_type')->index();

            $table->string('email');
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authenticables');
    }
}
