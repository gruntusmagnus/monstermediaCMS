<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggableModelsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('model_history', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('archivable_id')
                  ->index()
                  ->comment('Id of changed model');
            $table->string('archivable_type')
                  ->index()
                  ->comment('Changed model');
            $table->integer('user_id')
                  ->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::create('model_history_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('history_id')
                  ->unsigned();
            $table->string('column_name');
            $table->text('old_value')
                  ->nullable();
            $table->text('new_value')
                  ->nullable();
            $table->foreign('history_id')
                  ->references('id')
                  ->on('model_history')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_history_changes');
        Schema::dropIfExists('model_history');
    }
}
