<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b15623388abfRelationshipsToUserActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_actions', function(Blueprint $table) {
            if (!Schema::hasColumn('user_actions', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '167126_5b11573791b48')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('user_actions', function(Blueprint $table) {
            if(Schema::hasColumn('user_actions', 'user_id')) {
                $table->dropForeign('167126_5b11573791b48');
                $table->dropIndex('167126_5b11573791b48');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
