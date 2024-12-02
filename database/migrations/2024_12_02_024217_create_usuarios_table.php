<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 100)->nullable();
            $table->string('correo', 100)->nullable();
            $table->string('contraseña', 255)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->unsignedBigInteger('id_rol')->nullable();
            $table->timestamps();

            $table->foreign('id_rol')->references('id_rol')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
