<?php

namespace App\Http\Controllers;

use App\Models\Ataque;
use Illuminate\Http\Request;

class AtaqueController extends Controller
{
    // Obtener todos los ataques
    public function index()
    {
        $ataques = Ataque::all();
        return response()->json($ataques, 200);
    }

    // Crear un nuevo ataque
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'caracteristica' => 'required|string|max:255',
            'habilidad' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'total' => 'required|integer',
            'id_jugador' => 'required|integer|exists:jugadores,id',
        ]);

        $ataque = Ataque::create($validatedData);
        return response()->json($ataque, 201);
    }

    // Obtener un ataque específico
    public function show($id)
    {
        $ataque = Ataque::find($id);
        if (!$ataque) {
            return response()->json(['message' => 'Ataque no encontrado'], 404);
        }
        return response()->json($ataque, 200);
    }

    // Actualizar un ataque
    public function update(Request $request, $id)
    {
        $ataque = Ataque::find($id);
        if (!$ataque) {
            return response()->json(['message' => 'Ataque no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'caracteristica' => 'sometimes|string|max:255',
            'habilidad' => 'sometimes|string|max:255',
            'item' => 'sometimes|string|max:255',
            'total' => 'sometimes|integer',
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
        ]);

        $ataque->update($validatedData);
        return response()->json($ataque, 200);
    }

    // Eliminar un ataque
    public function destroy($id)
    {
        $ataque = Ataque::find($id);
        if (!$ataque) {
            return response()->json(['message' => 'Ataque no encontrado'], 404);
        }

        $ataque->delete();
        return response()->json(['message' => 'Ataque eliminado con éxito'], 200);
    }
}
