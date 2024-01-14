<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLlavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llaves', function (Blueprint $table) {
            $table->id();
            $table->string('nombreLlavePublica');
            $table->string('nombreLlavePrivada');
            $table->string('passLlavePrivada');
            $table->bigInteger('idResponsable')->unsigned();
            $table->bigInteger('idIpes')->unsigned();
            $table->timestamps();

            $table->foreign('idResponsable')->references('id')->on('responsables')->onDelete('cascade');
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
        Schema::dropIfExists('llaves');
    }
}
