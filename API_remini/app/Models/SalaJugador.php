<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaJugador extends Model
{
    use HasFactory;

    protected $table = 'salas_jugadores'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'id_jugador',
        'id_sala',
    ];

    public $timestamps = false; 

}
