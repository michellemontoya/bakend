<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esquivar extends Model
{
    use HasFactory;

    protected $table = 'esquivar'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'base',
        'destreza',
        'item',
        'total',
        'id_jugador',
    ];

    public $timestamps = false; 

}
