<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamiento extends Model
{
    use HasFactory;

    protected $table = 'equipamientos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'equipo',
        'habilitado',
        'id_jugador',
    ];

    public $timestamps = false; 

}
