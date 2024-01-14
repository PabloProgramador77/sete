<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreAlumno');
            $table->string('apellido1Alumno');
            $table->string('apellido2Alumno');
            $table->string('curpAlumno');
            $table->string('emailAlumno');
            $table->bigInteger('idIpes')->unsigned();
            $table->bigInteger('idCarrera')->unsigned();
            $table->timestamps();

            $table->foreign('idIpes')->references('id')->on('ipes')->onDelete('cascade');
            $table->foreign('idCarrera')->references('id')->on('carreras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
