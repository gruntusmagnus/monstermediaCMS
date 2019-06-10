<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('is_active')->default(true);
            $table->integer('customer_id')->unsigned();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('CASCADE');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('chat_id')->unsigned();

            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->text('content');

            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('CASCADE');
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('chats');
    }
}