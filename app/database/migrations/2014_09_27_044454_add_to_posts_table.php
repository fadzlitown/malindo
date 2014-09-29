<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddToPostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table) {
            $table->string('slug', 170);
            $table->string('code', 10);
            $table->enum('status', ['Aborted', 'Pending', 'Approved', 'Running', 'On Hold', 'Completed'])->default('Pending');
            $table->boolean("is_featured")->default(false);
            $table->boolean("is_sold")->default(false);
            $table->boolean("is_in_stock")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('code');
            $table->dropColumn('status');
            $table->dropColumn('is_featured');
            $table->dropColumn('is_sold');
            $table->dropColumn('is_in_stock');
        });
    }

}
