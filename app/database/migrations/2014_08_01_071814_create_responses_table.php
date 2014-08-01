<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('action_responses', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->integer('action_id');
            $table->enum('status', ['success', 'error']);
            $table->string('name');
            $table->string('value')->nullable();

            $table->index('action_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('action_responses', function(Blueprint $table) {
            $table->drop();
        });
	}

}
