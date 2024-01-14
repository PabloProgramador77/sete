<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('folioArchivo');
            $table->bigInteger('idIpes')->unsigned();
            $table->bigInteger('idExpedicion')->unsigned();
            $table->string('estatusArchivo');
            $table->timestamps();

            $table->foreign('idIpes')->references('id')->on('ipes')->onDelete('cascade');
            $table->foreign('idExpedicion')->references('id')->on('expediciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
