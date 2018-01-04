<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            // table engine
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsignedInteger();            
            $table->string('pnr');
            $table->integer('carrier_id')->unsignedInteger();            
            $table->integer('outbound_route')->unsignedInteger();            
            $table->integer('return_route')->unsignedInteger();            
            $table->dateTime('outbound_date');
            $table->dateTime('return_date');
            $table->timestamps();
        });
/*
        Schema::table('itineraries', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('outbound_route')->references('id')->on('cities');
            $table->foreign('return_route')->references('id')->on('cities');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itineraries');
    }
}
