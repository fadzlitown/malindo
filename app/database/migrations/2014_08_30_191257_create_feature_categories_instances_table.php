<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeatureCategoriesInstancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_categories_instances', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('feature_category_id')->unsigned();
            $table->timestamps();

            $table->foreign('feature_category_id')->references('id')->on('feature_categories')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feature_categories_isntances');
    }

}
