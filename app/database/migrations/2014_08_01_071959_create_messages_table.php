<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_messages', function(Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->integer('action_id');
            $table->enum('status', ['success', 'error']);
            $table->text('body');
            $table->integer('field_id')->nullable();
            $table->string('path')->nullable();

            $table->index('action_id');
            $table->index('field_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('action_messages');
    }

}
