<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloqueo extends Model
{
    use HasFactory;

    protected $table = 'bloqueos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'base',
        'constitucion',
        'item',
        'total',
        'id_jugador',
    ];
    public $timestamps = false; 

}

