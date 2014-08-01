<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_redirects', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->integer('action_id');
            $table->enum('status', ['success', 'error']);
            $table->string('uri');

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
        Schema::drop('action_redirects');
    }

}
