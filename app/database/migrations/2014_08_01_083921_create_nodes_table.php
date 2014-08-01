<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->string('uri');
            $table->integer('action_id');
            $table->string('label');

            $table->unique('uri');
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
        Schema::table('nodes', function(Blueprint $table) {
            $table->drop();
        });
    }

}
