<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('elements', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->integer('resource_id');
            $table->string('name');
            $table->enum('type', ['string', 'text', 'integer', 'float']);
            $table->string('label');

            $table->index('type');
            $table->unique(['resource_id', 'name']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('elements');
	}

}
