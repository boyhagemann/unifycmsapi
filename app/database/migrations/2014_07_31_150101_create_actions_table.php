<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->integer('resource_id');
            $table->string('name');
            $table->string('title');
            $table->string('uri');
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS']);
            $table->string('view');
            $table->longText('view_config');

            $table->unique(['resource_id', 'uri', 'method']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actions');
    }

}
