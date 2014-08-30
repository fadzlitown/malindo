<?php

use Illuminate\Database\Migrations\Migration,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('person_types_id')->unsigned();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->enum('title', array('Mr', 'Ms', 'Mrs', 'Dr', 'Professor', 'Madam', 'Undefined'))->default('Mr');
            $table->enum('gender', array('Male', 'Female', 'Undefined'))->default('Male');
            $table->date('dob')->nullable();
            $table->integer('addresses_id')->unsigned()->nullable();
            $table->string('phone', 15);
            $table->string('handphone', 15);
            $table->string('email', 50);
            $table->enum('marital_status', array('Single', 'Married', 'Divorced', 'Undefined'))->default('Single');
            $table->string('profile_img_url', 255)->nullable();
            $table->timestamps();

            $table->foreign('person_types_id')->references('id')->on('person_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('addresses_id')->references('id')->on('addresses')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('persons');
    }

}
