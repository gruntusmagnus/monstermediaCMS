<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('sex')->nullable();
            $table->unsignedInteger('company_id')->length(10)->nullable();
            $table->string('vat_number',20);
            $table->date('date_birth')->nullable();
            $table->unsignedInteger('language_id')->length(10);
            $table->unsignedInteger('customer_group_id')->length(10)->nullable();
            $table->integer('points');
            $table->boolean('gdpr');
            $table->text('note')->nullable();
            $table->timestamp('last_online')->nullable();
            $table->text('hash');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
