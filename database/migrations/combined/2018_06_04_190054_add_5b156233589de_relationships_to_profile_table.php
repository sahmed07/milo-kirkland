<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b156233589deRelationshipsToProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function(Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '167106_5b114d3a20aae')->references('id')->on('users')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function(Blueprint $table) {
            if(Schema::hasColumn('profiles', 'created_by_id')) {
                $table->dropForeign('167106_5b114d3a20aae');
                $table->dropIndex('167106_5b114d3a20aae');
                $table->dropColumn('created_by_id');
            }
            
        });
    }
}
