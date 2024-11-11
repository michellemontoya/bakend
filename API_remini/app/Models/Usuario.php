<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; // Nombre de la tabla

    protected $fillable = [
        'usuario',
        'clave',
        'rol',
        'avatar',
        'correo',
    ];

    public $timestamps = false; 
}

