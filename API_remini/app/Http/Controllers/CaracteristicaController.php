<?php
namespace App\Http\Controllers;

use App\Models\Caracteristica;
use Illuminate\Http\Request;

class CaracteristicaController extends Controller
{
    // Obtener todas las características
    public function index()
    {
        $caracteristicas = Caracteristica::all();
        return response()->json($caracteristicas, 200);
    }

    // Crear una nueva característica
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'caracteristica' => 'required|string|max:255',
            'p_base' => 'required|integer',
            'bonificador' => 'required|integer',
            'b_competencia' => 'required|integer',
            'suma_lado' => 'required|integer',
            'id_jugador' => 'required|integer|exists:jugadores,id',
        ]);

        $caracteristica = Caracteristica::create($validatedData);
        return response()->json($caracteristica, 201);
    }

    // Obtener una característica específica
    public function show($id)
    {
        $caracteristica = Caracteristica::find($id);
        if (!$caracteristica) {
            return response()->json(['message' => 'Característica no encontrada'], 404);
        }
        return response()->json($caracteristica, 200);
    }

    // Actualizar una característica
    public function update(Request $request, $id)
    {
        $caracteristica = Caracteristica::find($id);
        if (!$caracteristica) {
            return response()->json(['message' => 'Característica no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'caracteristica' => 'sometimes|string|max:255',
            'p_base' => 'sometimes|integer',
            'bonificador' => 'sometimes|integer',
            'b_competencia' => 'sometimes|integer',
            'suma_lado' => 'sometimes|integer',
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
        ]);

        $caracteristica->update($validatedData);
        return response()->json($caracteristica, 200);
    }

    // Eliminar una característica
    public function destroy($id)
    {
        $caracteristica = Caracteristica::find($id);
        if (!$caracteristica) {
            return response()->json(['message' => 'Característica no encontrada'], 404);
        }

        $caracteristica->delete();
        return response()->json(['message' => 'Característica eliminada con éxito'], 200);
    }
}
