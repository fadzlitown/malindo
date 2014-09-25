<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTodosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->text('note')->nullable();
            $table->datetime('due_date')->nullable();
            $table->datetime('reminder_date')->nullable();
            $table->enum('status', array('completed', 'in_progress', 'canceled'))->default('in_progress');
            $table->integer('account_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('todos');
    }

}
