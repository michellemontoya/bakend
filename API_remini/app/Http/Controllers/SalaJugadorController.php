<?php
namespace App\Http\Controllers;

use App\Models\SalaJugador;
use Illuminate\Http\Request;
use App\Models\Jugador;
use Illuminate\Support\Facades\DB;

class SalaJugadorController extends Controller
{
    // Obtener todos los registros de sala-jugador
    public function index()
    {
        $salasJugadores = SalaJugador::all();
        return response()->json($salasJugadores, 200);
    }

    // Crear un nuevo registro de sala-jugador
    public function store(Request $request)
    {
        $jugadores = Jugador::inRandomOrder()->limit($request->cant_jugadores)->get();
        
        foreach ($jugadores as $key => $value) {
            $salaJugador = SalaJugador::create(["id_sala"=> $request->id_sala, "id_jugador" => $value['id']]);
        }
        
        return response()->json($jugadores, 201);
    }

    public function obtenerJugadoresPorSala($idSala)
    {
        $jugadores = DB::table('salas_jugadores')
            ->join('jugadores', 'salas_jugadores.id_jugador', '=', 'jugadores.id')
            ->join('usuarios', 'jugadores.id_usuario', '=', 'usuarios.id')
            ->where('salas_jugadores.id_sala', $idSala)
            ->select('jugadores.id', 'usuarios.avatar')
            ->get();

        return response()->json($jugadores, 200);
    }


    public function asociarJugadores($cant, $id_sala)
    {
        $jugadores = Jugador::inRandomOrder()->limit($cant)->get();
        
        foreach ($jugadores as $key => $value) {
            $salaJugador = SalaJugador::create(["id_sala"=> $id_sala, "id_jugador" => $value['id']]);
        }
        
        return response()->json($jugadores, 201);
    }

    

    // Obtener un registro específico de sala-jugador
    public function show($id)
    {
        $salaJugador = SalaJugador::find($id);
        if (!$salaJugador) {
            return response()->json(['message' => 'Registro de SalaJugador no encontrado'], 404);
        }
        return response()->json($salaJugador, 200);
    }

    // Actualizar un registro de sala-jugador
    public function update(Request $request, $id)
    {
        $salaJugador = SalaJugador::find($id);
        if (!$salaJugador) {
            return response()->json(['message' => 'Registro de SalaJugador no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
            'id_sala' => 'sometimes|integer|exists:salas,id',
        ]);

        $salaJugador->update($validatedData);
        return response()->json($salaJugador, 200);
    }

    // Eliminar un registro de sala-jugador
    public function destroy($id)
    {
        $salaJugador = SalaJugador::find($id);
        if (!$salaJugador) {
            return response()->json(['message' => 'Registro de SalaJugador no encontrado'], 404);
        }

        $salaJugador->delete();
        return response()->json(['message' => 'Registro de SalaJugador eliminado con éxito'], 200);
    }
}
