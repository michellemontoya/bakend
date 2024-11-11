<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $table = 'salas';

    // Define los campos permitidos para asignación masiva
    protected $fillable = [
        'musica',
        'sonido',
        'brillo',
        'cant_jugadores',
        'id_usuario',
    ];

    public $timestamps = false; 

}

