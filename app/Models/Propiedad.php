<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    protected $table = 'Propiedades';
    protected $primaryKey = 'id_propiedad';
    public $timestamps = false;

    protected $fillable = [
        'direccion',
        'ciudad',
        'estado',
        'id_propietario',
    ];

    public function propietario()
    {
        return $this->belongsTo(Usuario::class, 'id_propietario', 'id_usuario');
    }

    public function historialPagos()
    {
        return $this->hasMany(HistorialPago::class, 'id_propiedad', 'id_propiedad');
    }
}