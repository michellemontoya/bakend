<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ataque extends Model
{
    use HasFactory;

    protected $table = 'ataques'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'caracteristica',
        'habilidad',
        'item',
        'total',
        'id_jugador',
    ];

    public $timestamps = false; 

}
