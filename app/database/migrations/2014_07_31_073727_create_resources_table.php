<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resources', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->string('slug');
            $table->string('title');
            $table->string('uri');

            $table->unique('slug');
            $table->unique('uri');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('resources', function(Blueprint $table) {
            $table->drop();
        });
	}

}
