<?php

use Illuminate\Database\Migrations\Migration,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->enum('title', array('Mr', 'Ms', 'Mrs', 'Dr', 'Professor', 'Madam', 'Undefined'))->default('Mr');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 64)->unique();
            $table->string('password', 64);
            $table->integer('plan_id')->unsigned();
            $table->smallinteger('confirmed')->unsigned();
            $table->string('confirmation', 32);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accounts');
    }

}
