<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeatureCategoriesInstancesMetasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_categories_instances_metas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100);
            $table->text('value');
            $table->integer('fci_id')->unsigned();
            $table->timestamps();

            $table->foreign('fci_id')->references('id')->on('feature_categories_instances')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feature_categories_instances_metas');
    }

}
