<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPago extends Model
{
    protected $table = 'historial_pagos';
    protected $primaryKey = 'id_historial';
    public $timestamps = false;

    protected $fillable = [
        'id_inquilino',
        'fecha_inicio_fin',
        'valoracion',
        'observaciones',
        'afectaciones_materiales',
        'propiedad',
    ];

    public function inquilino()
    {
        return $this->belongsTo(Usuario::class, 'id_inquilino', 'id_usuario');
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad', 'id_propiedad');
    }
}