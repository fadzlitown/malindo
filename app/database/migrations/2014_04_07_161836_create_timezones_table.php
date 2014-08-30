<?php

use Illuminate\Database\Migrations\Migration,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Support\Facades\Schema;

class CreateTimezonesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezones', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('timezone_location', 30);
            $table->string('gmt', 11);
            $table->smallinteger("offset", false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('timezones');
    }

}
