<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePnrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnrs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pnr');
            $table->integer('change_id')->unsignedInteger();
            $table->string('passenger', 60);
            $table->string('phone', 30);
            $table->boolean('status')->default(1);
            $table->mediumText('comments');
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
        Schema::dropIfExists('pnrs');
    }
}
