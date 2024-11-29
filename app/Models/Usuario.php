<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'Usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
        'fecha_registro',
        'id_rol',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_propietario', 'id_usuario');
    }

    public function historialPagos()
    {
        return $this->hasMany(HistorialPago::class, 'id_inquilino', 'id_usuario');
    }
}