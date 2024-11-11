<?php

namespace App\Http\Controllers;

use App\Models\Equipamiento;
use Illuminate\Http\Request;

class EquipamientoController extends Controller
{
    // Obtener todos los equipamientos
    public function index()
    {
        $equipamientos = Equipamiento::all();
        return response()->json($equipamientos, 200);
    }

    // Crear un nuevo equipamiento
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'equipo' => 'required|string|max:255',
            'id_jugador' => 'required|integer|exists:jugadores,id',
        ]);

        $equipamiento = Equipamiento::create($validatedData);
        return response()->json($equipamiento, 201);
    }

    // Obtener un equipamiento específico
    public function show($id)
    {
        $equipamiento = Equipamiento::find($id);
        if (!$equipamiento) {
            return response()->json(['message' => 'Equipamiento no encontrado'], 404);
        }
        return response()->json($equipamiento, 200);
    }

    // Actualizar un equipamiento
    public function update(Request $request, $id)
    {
        $equipamiento = Equipamiento::find($id);
        if (!$equipamiento) {
            return response()->json(['message' => 'Equipamiento no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'equipo' => 'sometimes|string|max:255',
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
        ]);

        $equipamiento->update($validatedData);
        return response()->json($equipamiento, 200);
    }

    // Eliminar un equipamiento
    public function destroy($id)
    {
        $equipamiento = Equipamiento::find($id);
        if (!$equipamiento) {
            return response()->json(['message' => 'Equipamiento no encontrado'], 404);
        }

        $equipamiento->delete();
        return response()->json(['message' => 'Equipamiento eliminado con éxito'], 200);
    }
}
