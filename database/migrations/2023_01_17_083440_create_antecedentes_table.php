<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombreAntecedente');
            $table->string('fechaInicioAntecedente');
            $table->string('fechaFinalAntecedente');
            $table->string('cedulaAntecedente')->nullable();
            $table->bigInteger('idIpes')->unsigned();
            $table->bigInteger('idEntidad')->unsigned();
            $table->bigInteger('idEstudio')->unsigned();
            $table->bigInteger('idAlumno')->unsigned();
            $table->timestamps();

            $table->foreign('idIpes')->references('id')->on('ipes')->onDelete('cascade');
            $table->foreign('idEntidad')->references('id')->on('entidad_federativas')->onDelete('cascade');
            $table->foreign('idEstudio')->references('id')->on('estudios')->onDelete('cascade');
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antecedentes');
    }
}
