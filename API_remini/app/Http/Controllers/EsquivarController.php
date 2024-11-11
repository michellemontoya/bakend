<?php
namespace App\Http\Controllers;

use App\Models\Esquivar;
use Illuminate\Http\Request;

class EsquivarController extends Controller
{
    // Obtener todos los esquivars
    public function index()
    {
        $esquivars = Esquivar::all();
        return response()->json($esquivars, 200);
    }

    // Crear un nuevo esquivar
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'base' => 'required|integer',
            'destreza' => 'required|integer',
            'item' => 'required|integer',
            'total' => 'required|integer',
            'id_jugador' => 'required|integer|exists:jugadores,id',
        ]);

        $esquivar = Esquivar::create($validatedData);
        return response()->json($esquivar, 201);
    }

    // Obtener un esquivar específico
    public function show($id)
    {
        $esquivar = Esquivar::find($id);
        if (!$esquivar) {
            return response()->json(['message' => 'Esquivar no encontrado'], 404);
        }
        return response()->json($esquivar, 200);
    }

    // Actualizar un esquivar
    public function update(Request $request, $id)
    {
        $esquivar = Esquivar::find($id);
        if (!$esquivar) {
            return response()->json(['message' => 'Esquivar no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'base' => 'sometimes|integer',
            'destreza' => 'sometimes|integer',
            'item' => 'sometimes|integer',
            'total' => 'sometimes|integer',
            'id_jugador' => 'sometimes|integer|exists:jugadores,id',
        ]);

        $esquivar->update($validatedData);
        return response()->json($esquivar, 200);
    }

    // Eliminar un esquivar
    public function destroy($id)
    {
        $esquivar = Esquivar::find($id);
        if (!$esquivar) {
            return response()->json(['message' => 'Esquivar no encontrado'], 404);
        }

        $esquivar->delete();
        return response()->json(['message' => 'Esquivar eliminado con éxito'], 200);
    }
}
