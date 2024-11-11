<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Http\Controllers\SalaJugadorController;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    // Obtener todas las salas
    public function index()
    {
        $salas = Sala::all();
        return response()->json($salas);
    }

    // Crear una nueva sala
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'musica' => 'required|integer', 
            'sonido' => 'required|integer', 
            'brillo' => 'required|integer',
            'cant_jugadores' => 'required|integer',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        $sala = Sala::create($validatedData);

        $sala_jugador = new SalaJugadorController();
        $sala_jugador->asociarJugadores($validatedData['cant_jugadores'], $sala->id);

        return response()->json($sala, 201);
    }


    // Mostrar una sala específica
    public function show($id)
    {
        $sala = Sala::find($id);

        if (!$sala) {
            return response()->json(['message' => 'Sala no encontrada'], 404);
        }

        return response()->json($sala);
    }

    // Actualizar una sala específica
    public function update(Request $request, $id)
    {
        $sala = Sala::find($id);

        if (!$sala) {
            return response()->json(['message' => 'Sala no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'musica' => 'required|integer', 
            'sonido' => 'required|integer', 
            'brillo' => 'sometimes|integer',
            'cant_jugadores' => 'sometimes|integer',
            'id_usuario' => 'sometimes|exists:usuarios,id',
        ]);

        $sala->update($validatedData);

        return response()->json($sala);
    }

    // Eliminar una sala específica
    public function destroy($id)
    {
        $sala = Sala::find($id);

        if (!$sala) {
            return response()->json(['message' => 'Sala no encontrada'], 404);
        }

        $sala->delete();

        return response()->json(['message' => 'Sala eliminada con éxito']);
    }
}
