<?php

use Illuminate\Database\Migrations\Migration,
    Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function($table) {
            $table->increments('id')->unsigned();
            $table->string('name', 64);
            $table->text('description')->nullable();
            $table->string('currency', 3);
            $table->decimal('price', 5, 2);
            $table->enum('billing_cycle', array('day', 'month', 'quarter', 'year'))->default('day');
            $table->enum('limit_type', array('time', 'events', 'recommendations'))->default('time');
            $table->integer('limit_value')->unsigned();
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
        Schema::drop('plans');
    }

}
