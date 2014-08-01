<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('fields', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->integer('action_id');
            $table->integer('element_id');

            $table->string('view');
            $table->longText('view_config');
            $table->integer('order');

            $table->unique(['action_id', 'element_id']);
            $table->index('order');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('fields');
	}

}
