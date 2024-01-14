<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsables', function (Blueprint $table) {
            $table->id();
            $table->string('nombreResponsable');
            $table->string('apellido1Responsable');
            $table->string('apellido2Responsable');
            $table->string('curpResponsable');
            $table->string('tituloResponsable')->nullable();
            $table->bigInteger('idIpes')->unsigned();
            $table->bigInteger('idCargo')->unsigned();
            $table->timestamps();

            $table->foreign('idIpes')->references('id')->on('ipes')->onDelete('cascade');
            $table->foreign('idCargo')->references('id')->on('cargos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsables');
    }
}
