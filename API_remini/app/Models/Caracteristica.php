<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $table = 'caracteristicas'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'caracteristica',
        'p_base',
        'bonificador',
        'b_competencia',
        'suma_lado',
        'id_jugador',
    ];
    public $timestamps = false; 

}
