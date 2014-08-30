<?php

use Illuminate\Database\Migrations\Migration,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('address', 50);
            $table->string('address2', 50);
            $table->smallinteger('country_id', false);
            $table->string('state', 80);
            $table->string('city', 80);
            $table->string('postal_code', 10);
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
        Schema::drop('addresses');
    }

}
