<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*

        CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT 'Parent module ID (when module is submodule)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `static_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL COMMENT 'Is this module in use?',
  `module_settings` text COLLATE utf8_unicode_ci COMMENT 'JSON serialized object with configuration of given module.',
  `has_submodules` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_handler_unique` (`handler`),
  KEY `modules_enabled_index` (`enabled`),
  KEY `modules_parent_id_foreign` (`parent_id`),
  CONSTRAINT `modules_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

         * */

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('parent_id')->nullable(true);
            $table->string('name');
            $table->text('description');
            $table->string('static_name');
            $table->string('alias');
            $table->boolean('enabled')->index();
            $table->boolean('has_submodules');
            $table->string('service_provider');
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('modules')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
