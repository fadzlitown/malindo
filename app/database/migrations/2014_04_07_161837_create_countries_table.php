<?php

use Illuminate\Database\Migrations\Migration,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char("iso", 2);
            $table->string('name', 80);
            $table->string('nicename', 80);
            $table->char("iso3", 3)->nullable();
            $table->smallinteger("numcode", false)->nullable();
            $table->smallinteger("phonecode", false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('countries');
    }

}
