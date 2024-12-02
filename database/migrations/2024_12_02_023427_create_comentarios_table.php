<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('id_comentarios');
            $table->unsignedBigInteger('arrendador')->nullable();
            $table->string('nombre_arrendatario', 45)->nullable();
            $table->string('comentario', 100)->nullable();
            $table->string('publicante', 45)->nullable();
            $table->timestamps();

            $table->foreign('arrendador')->references('id_usuario')->on('usuarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
