<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('code',16)->nullable()->change();
            $table->unsignedInteger('payment_id')->length(10)->nullable()->change();
            $table->unsignedInteger('table_number')->length(10)->nullable()->change();

            $table->decimal('total_price',12,6)->default(0)->change();
            $table->decimal('total_tax',12,6)->default(0)->change();
            $table->decimal('total_sum',12,6)->default(0)->change();
            $table->boolean('completed')->default(0)->change();
        });
    }
}
