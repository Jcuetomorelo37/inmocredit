<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentarios';
    public $timestamps = false;

    protected $fillable = [
        'arrendador',
        'nombre_arrendatario',
        'comentario',
        'publicante',
    ];
}
