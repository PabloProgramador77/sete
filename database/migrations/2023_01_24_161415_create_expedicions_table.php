<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediciones', function (Blueprint $table) {
            $table->id();
            $table->string('servicioSocial');
            $table->bigInteger('idTitulacion')->unsigned();
            $table->string('fechaExamen')->nullable();
            $table->string('fechaExencion')->nullable();
            $table->bigInteger('idFundamento')->unsigned();
            $table->bigInteger('idEntidad')->unsigned();
            $table->bigInteger('idAlumno')->unsigned();
            $table->timestamps();

            $table->foreign('idTitulacion')->references('id')->on('titulaciones')->onDelete('cascade');
            $table->foreign('idFundamento')->references('id')->on('fundamentos')->onDelete('cascade');
            $table->foreign('idEntidad')->references('id')->on('entidad_federativas')->onDelete('cascade');
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
        Schema::dropIfExists('expedicions');
    }
}
