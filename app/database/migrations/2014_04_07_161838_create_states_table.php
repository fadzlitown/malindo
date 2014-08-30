<?php

use Illuminate\Database\Migrations\Migration,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100);
            $table->string('short_name', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('states');
    }

}
