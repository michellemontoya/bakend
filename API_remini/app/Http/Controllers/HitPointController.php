<?php
namespace App\Http\Controllers;

use App\Models\HitPoint;
use Illuminate\Http\Request;

class HitPointController extends Controller
{
    // Obtener todos los hit points
    public function index()
    {
        $hitPoints = HitPoint::all();
        return response()->json($hitPoints, 200);
    }

    // Crear un nuevo hit point
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'base' => 'required|integer',
            'daño_sufrido' => 'required|integer',
            'total' => 'required|integer',
            'id_jugador' => 'required|integer|exists:jugadores,id',
        ]);

        $hitPoint = HitPoint::create($validatedData);
        return response()->json($hitPoint, 201);
    }

    // Obtener un hit point específico
    public function show($id)
    {
        $hitPoint = HitPoint::find($id);
        if (!$hitPoint) {
            return response()->json(['message' => 'Hit Point no encontrado'], 404);
        }
        return response()->json($hitPoint, 200);
    }

    // Actualizar un hit point
    public function update(Request $request, $id)
    {
        $hitPoint = HitPoint::find($id);
        if (!$hitPoint) {
            return response()->json(['message' => 'Hit Point no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'base' => 'sometimes|integer',
            'daño_sufrido' => 'sometimes|integer',
            'total' => 'sometimes|integer',
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
        ]);

        $hitPoint->update($validatedData);
        return response()->json($hitPoint, 200);
    }

    // Eliminar un hit point
    public function destroy($id)
    {
        $hitPoint = HitPoint::find($id);
        if (!$hitPoint) {
            return response()->json(['message' => 'Hit Point no encontrado'], 404);
        }

        $hitPoint->delete();
        return response()->json(['message' => 'Hit Point eliminado con éxito'], 200);
    }
}
