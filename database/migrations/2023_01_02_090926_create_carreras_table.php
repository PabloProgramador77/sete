<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCarrera');
            $table->string('rvoeCarrera');
            $table->string('claveCarrera');
            $table->bigInteger('idAutoridad')->unsigned();
            $table->bigInteger('idIpes')->unsigned();
            $table->timestamps();

            $table->foreign('idAutoridad')->references('id')->on('autoridades')->onDelete('cascade');
            $table->foreign('idIpes')->references('id')->on('ipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
}
