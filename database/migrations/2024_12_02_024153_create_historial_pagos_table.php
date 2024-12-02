<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialPagosTable extends Migration
{
    public function up()
    {
        Schema::create('historial_pagos', function (Blueprint $table) {
            $table->id('id_historial');
            $table->unsignedBigInteger('id_inquilino')->nullable();
            $table->text('fecha_inicio_fin')->nullable();
            $table->integer('valoracion')->nullable();
            $table->text('observaciones')->default('sin comentarios...');
            $table->text('afectaciones_materiales')->default('ningún daño a la propiedad');
            $table->unsignedBigInteger('propiedad')->nullable();
            $table->timestamps();

            $table->foreign('id_inquilino')->references('id_usuario')->on('usuarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('propiedad')->references('id_propiedad')->on('propiedades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_pagos');
    }
}
