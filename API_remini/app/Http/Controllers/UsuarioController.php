<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\JugadorController;
use Illuminate\Support\Facades\DB;


class UsuarioController extends Controller
{
    // Obtener todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios, 200);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'usuario' => 'required|string|max:255',
            'clave' => 'required|string|max:255',
            'correo' => 'sometimes|string|max:255',
            'rol' => 'required|string|max:255',
            'avatar' => 'nullable|string|max:255',
        ]);

        // Encriptar la clave
        $validatedData['clave'] = bcrypt($validatedData['clave']);
        $usuario = Usuario::create($validatedData);

        if($validatedData['rol']=="Jugador"){
            $jugador = new JugadorController();
            $jugador->guardarIdUsuario($usuario->id);
        }
        return response()->json($usuario, 201);
    }

    // Obtener un usuario específico
    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario, 200);
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'usuario' => 'sometimes|string|max:255',
            'clave' => 'sometimes|string|max:255',
            'correo' => 'sometimes|string|max:255',
            'rol' => 'sometimes|string|max:255',
            'avatar' => 'nullable|string|max:255',
        ]);

        // Encriptar la clave si se proporciona
        if (isset($validatedData['clave'])) {
            $validatedData['clave'] = bcrypt($validatedData['clave']);
        }

        $usuario->update($validatedData);
        return response()->json($usuario, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
    }

    // Verificar usuario y clave
    public function verificarUsuario(Request $request)
    {
        $validatedData = $request->validate([
            'usuario' => 'required|string',
            'clave' => 'required|string',
        ]);

        // Buscar al usuario por el nombre de usuario
        $usuario = Usuario::where('usuario', $validatedData['usuario'])->first();


        
        // Verificar si el usuario existe y la clave es correcta
        if ($usuario && Hash::check($validatedData['clave'], $usuario->clave)) {
            if ($usuario['rol'] == "Jugador") {
                $sala = DB::table('salas_jugadores')
                ->leftJoin('jugadores', 'salas_jugadores.id_jugador', '=', 'jugadores.id')
                ->join('usuarios', 'jugadores.id_usuario', '=', 'usuarios.id')
                ->where('usuarios.id', $usuario->id)
                ->select('salas_jugadores.id_sala')
                ->first();
                $jugadores = DB::table('jugadores')
                ->join('usuarios', 'jugadores.id_usuario', '=', 'usuarios.id')
                ->where('usuarios.id', $usuario->id)
                ->select('jugadores.id')
                ->first();
                $usuario['id_sala'] = $sala ? $sala->id_sala : null;
                $usuario['id_jugador'] = $jugadores ? $jugadores->id : null;
            }else{
                $sala = DB::table('salas')
                ->where('salas.id_usuario', $usuario->id)
                ->select('salas.id')
                ->first();
                $usuario['id_sala'] = $sala->id;
            }
            return response()->json(['message' => 'Usuario verificado con éxito', 'data'=> $usuario], 200);
        } else {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
    }
}
