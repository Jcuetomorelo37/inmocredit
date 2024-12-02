<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadesTable extends Migration
{
    public function up()
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id('id_propiedad');
            $table->string('direccion', 255)->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->unsignedBigInteger('id_propietario')->nullable();
            $table->string('estado', 50)->nullable();
            $table->timestamps();

            $table->foreign('id_propietario')->references('id_usuario')->on('usuarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('propiedades');
    }
}
