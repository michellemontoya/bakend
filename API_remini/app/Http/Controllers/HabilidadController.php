<?php

namespace App\Http\Controllers;

use App\Models\Habilidad;
use Illuminate\Http\Request;

class HabilidadController extends Controller
{
    // Obtener todas las habilidades
    public function index()
    {
        $habilidades = Habilidad::all();
        return response()->json($habilidades, 200);
    }

    // Crear una nueva habilidad
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'habilidad' => 'required|string|max:255',
            'id_jugador' => 'required|integer|exists:jugadores,id',
        ]);

        $habilidad = Habilidad::create($validatedData);
        return response()->json($habilidad, 201);
    }

    // Obtener una habilidad específica
    public function show($id)
    {
        $habilidad = Habilidad::find($id);
        if (!$habilidad) {
            return response()->json(['message' => 'Habilidad no encontrada'], 404);
        }
        return response()->json($habilidad, 200);
    }

    // Actualizar una habilidad
    public function update(Request $request, $id)
    {
        $habilidad = Habilidad::find($id);
        if (!$habilidad) {
            return response()->json(['message' => 'Habilidad no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'habilidad' => 'sometimes|string|max:255',
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
        ]);

        $habilidad->update($validatedData);
        return response()->json($habilidad, 200);
    }

    // Eliminar una habilidad
    public function destroy($id)
    {
        $habilidad = Habilidad::find($id);
        if (!$habilidad) {
            return response()->json(['message' => 'Habilidad no encontrada'], 404);
        }

        $habilidad->delete();
        return response()->json(['message' => 'Habilidad eliminada con éxito'], 200);
    }
}

