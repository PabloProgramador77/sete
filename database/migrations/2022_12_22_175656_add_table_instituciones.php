<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableInstituciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipes', function(Blueprint $table){
            $table->id();
            $table->string('nombreIpes');
            $table->string('claveIpes');
            $table->string('emailIpes');
            $table->string('passIpes');
            $table->string('estatusIpes');
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
        Schema::dropIfExists('ipes');
    }
}
