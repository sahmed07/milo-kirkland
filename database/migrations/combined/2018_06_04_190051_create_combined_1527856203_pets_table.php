<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1527856203PetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('pets')) {
            Schema::create('pets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('tag_id')->nullable();
                $table->string('pet_photo')->nullable();
                $table->string('pet_name')->nullable();
                $table->string('pet_type')->nullable();
                $table->string('pet_breed')->nullable();
                $table->string('pet_color')->nullable();
                $table->string('pet_age')->nullable();
                $table->string('pet_sex')->nullable();
                $table->string('behaviour')->nullable();
                $table->string('pet_size')->nullable();
                $table->string('distinctive_sign')->nullable();
                $table->enum('microchip', array('Yes', 'No'))->nullable();
                $table->string('sprayed_neutered')->nullable();
                $table->enum('rabies_vacc', array('Yes', 'No'))->nullable();
                $table->enum('pet_status', array('Active', 'Deceased', 'Lost'))->nullable();
                $table->enum('pay_status', array('Paid', 'Unpaid'))->nullable();
                
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
        Schema::dropIfExists('pets');
    }
}
