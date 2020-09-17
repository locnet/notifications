<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itinerary_id')->unsignedInteger();
            $table->string('departure_station');
            $table->string('arrival_station');
            $table->boolean('return_flight');
            $table->dateTime('outbound_dep_time');            
            $table->dateTime('outbound_arr_time'); 
            $table->boolean('outbound_scale');
            $table->string('outbound_scale_station',40);
            $table->dateTime('outbound_scale_start_time');            
            $table->dateTime('outbound_scale_end_time');
            $table->dateTime('return_dep_time');
            $table->dateTime('return_arr_time');
            $table->boolean('return_scale');
            $table->string('return_scale_station',40);   
            $table->dateTime('return_scale_start_time');
            $table->dateTime('return_scale_end_time');
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
        Schema::dropIfExists('changes');
    }
}
