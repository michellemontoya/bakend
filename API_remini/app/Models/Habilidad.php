<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    use HasFactory;

    protected $table = 'habilidades'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'habilidad',
        'bloqueado',
        'id_jugador',
    ];

    public $timestamps = false; 

}
