<?php

namespace App\Http\Controllers;

use App\Models\Bloqueo;
use Illuminate\Http\Request;

class BloqueoController extends Controller
{
    // Obtener todos los bloqueos
    public function index()
    {
        $bloqueos = Bloqueo::all();
        return response()->json($bloqueos, 200);
    }

    // Crear un nuevo bloqueo
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'base' => 'required|integer',
            'constitucion' => 'required|integer',
            'item' => 'required|integer',
            'total' => 'required|integer',
            'id_jugador' => 'required|integer|exists:jugadores,id',
        ]);

        $bloqueo = Bloqueo::create($validatedData);
        return response()->json($bloqueo, 201);
    }

    // Obtener un bloqueo específico
    public function show($id)
    {
        $bloqueo = Bloqueo::find($id);
        if (!$bloqueo) {
            return response()->json(['message' => 'Bloqueo no encontrado'], 404);
        }
        return response()->json($bloqueo, 200);
    }

    // Actualizar un bloqueo
    public function update(Request $request, $id)
    {
        $bloqueo = Bloqueo::find($id);
        if (!$bloqueo) {
            return response()->json(['message' => 'Bloqueo no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'base' => 'sometimes|integer',
            'constitucion' => 'sometimes|integer',
            'item' => 'sometimes|integer',
            'total' => 'sometimes|integer',
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
        ]);

        $bloqueo->update($validatedData);
        return response()->json($bloqueo, 200);
    }

    // Eliminar un bloqueo
    public function destroy($id)
    {
        $bloqueo = Bloqueo::find($id);
        if (!$bloqueo) {
            return response()->json(['message' => 'Bloqueo no encontrado'], 404);
        }

        $bloqueo->delete();
        return response()->json(['message' => 'Bloqueo eliminado con éxito'], 200);
    }
}
