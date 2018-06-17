<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527860534ProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('profiles')) {
            Schema::create('profiles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('firstname')->nullable();
                $table->string('lastname')->nullable();
                $table->date('dob')->nullable();
                $table->string('address_address')->nullable();
                $table->double('address_latitude')->nullable();
                $table->double('address_longitude')->nullable();
                $table->string('city')->nullable();
                $table->string('province')->nullable();
                $table->string('postalcode')->nullable();
                $table->string('phone')->nullable();
                $table->string('auth_user_fname')->nullable();
                $table->string('auth_user_lname')->nullable();
                $table->string('auth_user_phone')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
