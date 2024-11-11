<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HitPoint extends Model
{
    use HasFactory;

    protected $table = 'hit_points'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'base',
        'daño_sufrido',
        'total',
        'id_jugador',
    ];

    public $timestamps = false; 

}

