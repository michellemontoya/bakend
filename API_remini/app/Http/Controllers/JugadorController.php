<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Habilidad;
use App\Models\HitPoint;
use App\Models\Ataque;
use App\Models\Bloqueo;
use App\Models\Caracteristica;
use App\Models\Esquivar;
use App\Models\Equipamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class JugadorController extends Controller
{
    // Obtener todos los jugadores
    public function index()
    {
        $jugadores = Jugador::all();
        return response()->json($jugadores, 200);
    }

    public function jugadoresConocidos(Request $request)
    {
        $jugadores = DB::table('salas_jugadores')
            ->join('jugadores', 'salas_jugadores.id_jugador', '=', 'jugadores.id')
            ->join('usuarios', 'jugadores.id_usuario', '=', 'usuarios.id')
            ->where('salas_jugadores.id_sala', $request->id_sala)
            ->where('salas_jugadores.id_jugador', '!=', $request->id_jugador)
            ->select('usuarios.avatar', 'usuarios.usuario', 'jugadores.alias')
            ->limit(4)
            ->get();

        return response()->json($jugadores, 200);
    }


    public function cantidadJugadores()
    {
        $cantidad = Jugador::count();
        return response()->json(['cantidad' => $cantidad], 200);
    }

    // Crear un nuevo jugador
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'alias' => 'required|string|max:255',
            'edad' => 'required|integer',
            'altura' => 'required|numeric',
            'nivel' => 'required|integer',
            'bon_competencias' => 'required|integer',
            'id_usuario' => 'required|integer|exists:usuarios,id',
        ]);

        $jugador = Jugador::create($validatedData);

       




        return response()->json($jugador, 201);
    }

    // Crear un nuevo jugador
    public function guardarIdUsuario( $id_usuario)
    {
        try {
            $jugador = Jugador::create(['id_usuario' => $id_usuario]    );

            $boqueo = Bloqueo::create(["base"=>0,"constitucion"=>0,"item"=>0,"total"=>0,"id_jugador"=>  $jugador->id]);

            $hit_point = HitPoint::create(["base"=>0,"daño_sufrido"=>0,"total"=>0,"id_jugador"=>  $jugador->id]);

            $esquivar = Esquivar::create(["base"=>0,"destreza"=>0,"item"=>0,"total"=>0,"id_jugador"=>  $jugador->id]);

            $ataque = Ataque::create(["caracteristica"=>0,"habilidad"=>0,"item"=>0,"total"=>0,"id_jugador"=>  $jugador->id]);

            $caracteristica = Caracteristica::create(["caracteristica"=>"Musculatura","p_base"=>0,"bonificador"=>0,"b_competencia"=>0,"suma_lado"=>0,"id_jugador"=>  $jugador->id]);
            $caracteristica = Caracteristica::create(["caracteristica"=>"Puntería","p_base"=>0,"bonificador"=>0,"b_competencia"=>0,"suma_lado"=>0,"id_jugador"=>  $jugador->id]);
            $caracteristica = Caracteristica::create(["caracteristica"=>"Salud","p_base"=>0,"bonificador"=>0,"b_competencia"=>0,"suma_lado"=>0,"id_jugador"=>  $jugador->id]);
            $caracteristica = Caracteristica::create(["caracteristica"=>"Lógica","p_base"=>0,"bonificador"=>0,"b_competencia"=>0,"suma_lado"=>0,"id_jugador"=>  $jugador->id]);
            $caracteristica = Caracteristica::create(["caracteristica"=>"Intuición","p_base"=>0,"bonificador"=>0,"b_competencia"=>0,"suma_lado"=>0,"id_jugador"=>  $jugador->id]);
            $caracteristica = Caracteristica::create(["caracteristica"=>"Verborrea","p_base"=>0,"bonificador"=>0,"b_competencia"=>0,"suma_lado"=>0,"id_jugador"=>  $jugador->id]);

            $habilidad = Habilidad::create(["habilidad"=>"Torbellino de Espadas","bloqueado"=>0, "id_jugador"=>  $jugador->id]);
            $habilidad = Habilidad::create(["habilidad"=>"Reflejos Felinos","bloqueado"=>0, "id_jugador"=>  $jugador->id]);
            $habilidad = Habilidad::create(["habilidad"=>"Maestro de Armas","bloqueado"=>0, "id_jugador"=>  $jugador->id]);
            $habilidad = Habilidad::create(["habilidad"=>"Espada Llameante","bloqueado"=>0, "id_jugador"=>  $jugador->id]);
            $habilidad = Habilidad::create(["habilidad"=>"Golpe de Sangre","bloqueado"=>0, "id_jugador"=>  $jugador->id]);
            $habilidad = Habilidad::create(["habilidad"=>"Flecha Explosiva","bloqueado"=>0, "id_jugador"=>  $jugador->id]);
            $habilidad = Habilidad::create(["habilidad"=>"Curación Rápida","bloqueado"=>0, "id_jugador"=>  $jugador->id]);

            $equipamiento = Equipamiento::create(["equipo"=>"https://png.pngtree.com/png-clipart/20220131/original/pngtree-ancient-bow-and-arrow-flat-design-png-image_7258252.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://cdn.pixabay.com/photo/2020/10/29/01/58/knight-5694979_1280.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://png.pngtree.com/png-clipart/20230524/original/pngtree-money-bag-vector-png-image_9168976.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://images.vexels.com/content/151592/preview/blue-diamond-flat-icon-2f1961.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://png.pngtree.com/png-clipart/20220620/original/pngtree-sword-cartoon-illustration-design-png-image_8132150.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://images.vexels.com/media/users/3/207228/isolated/preview/affec54749806d2752556ed7e77378c6-mapa-de-ubicacion-colorido-icono-trazo.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://images.vexels.com/media/users/3/285777/isolated/preview/9b74ab55e037b80ee57bba056c315045-pocia-n-rosa-brillante.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://static.vecteezy.com/system/resources/previews/028/286/528/non_2x/a-green-potion-png.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);
            $equipamiento = Equipamiento::create(["equipo"=>"https://png.pngtree.com/png-clipart/20230407/original/pngtree-medieval-knight-shield-on-transparent-background-png-image_9032949.png","habilitado"=>0, "id_jugador"=>  $jugador->id]);

            return response()->json($jugador, 201);

        } catch (\Exception $e) {
            // En caso de error, devolver el mensaje de error
            return response()->json(['error' => 'Hubo un error al guardar los datos', 'mensaje' => $e->getMessage()], 500);
        }
    }

    public function actualizarDatos(Request $request)
    {
        try {
            
            $jugador = Jugador::find($request->id);
            if (!$jugador) {
                return response()->json(['message' => 'Jugador no encontrado'], 404);
            }

            $data = [
                'alias' => $request->alias,
                'edad' => $request->edad,
                'altura' => $request->altura,
                'nivel' => $request->nivel,
                'bon_competencias' => $request->bon_competencias,
            ];

            $jugador->update($data);
            
            //actualiza bloqueo
            $bloqueo = Bloqueo::find($request->bloqueo['id']);
            if (!$bloqueo) {
                return response()->json(['message' => 'bloqueo no encontrado'], 404);
            }

            $data_bloqueo = [
                "base"=> $request->bloqueo['base'],
                "constitucion"=> $request->bloqueo['constitucion'],
                "item"=> $request->bloqueo['item'],
                "total"=> $request->bloqueo['total']
            ];

            $bloqueo->update($data_bloqueo);

            //actualiza hit point
            $hit_point = HitPoint::find($request->hit_point['id']);
            if (!$hit_point) {
                return response()->json(['message' => 'hit_point no encontrado'], 404);
            }

            $data_hit_point = [
                "base"=> $request->hit_point['base'],
                "daño_sufrido"=> $request->hit_point['daño_sufrido'],
                "total"=> $request->hit_point['total']
            ];

            $hit_point->update($data_hit_point);

            //actualiza esquivar
            $esquivar = Esquivar::find($request->esquivar['id']);
            if (!$esquivar) {
                return response()->json(['message' => 'esquivar no encontrado'], 404);
            }

            $data_esquivar = [
                "base"=> $request->esquivar['base'],
                "destreza"=> $request->esquivar['destreza'],
                "item"=> $request->esquivar['item'],
                "total"=> $request->esquivar['total']
            ];

            $esquivar->update($data_esquivar);

            //actualizar ataque
            $ataque = Ataque::find($request->ataque['id']);
            if (!$ataque) {
                return response()->json(['message' => 'ataque no encontrado'], 404);
            }

            $data_ataque = [
                "caracteristica"=> $request->ataque['caracteristica'],
                "habilidad"=> $request->ataque['habilidad'],
                "item"=> $request->ataque['item'],
                "total"=> $request->ataque['total']
            ];

            $ataque->update($data_ataque);

            return response()->json($jugador, 201);

        } catch (\Exception $e) {
            // En caso de error, devolver el mensaje de error
            return response()->json(['error' => 'Hubo un error al guardar los datos', 'mensaje' => $e->getMessage()], 500);
        }
    }


    public function actualizarDatosOtros(Request $request)
    {
        // Validamos la data recibida
        $data = $request->validate([
            'caracteristicas' => 'required|array',
            'caracteristicas.*.id' => 'required|integer|exists:caracteristicas,id',
            'caracteristicas.*.p_base' => 'required|integer',
            'caracteristicas.*.bonificador' => 'required|integer',
            'caracteristicas.*.b_competencia' => 'required|integer',
            'caracteristicas.*.suma_lado' => 'required|integer',
            
            'habilidades' => 'required|array',
            'habilidades.*.id' => 'required|integer|exists:habilidades,id',
            'habilidades.*.bloqueado' => 'required|integer',
            
            'equipamientos' => 'required|array',
            'equipamientos.*.id' => 'required|integer|exists:equipamientos,id',
            'equipamientos.*.habilitado' => 'required|integer',
        ]);

        // Procesamos las características
        foreach ($data['caracteristicas'] as $caracteristicaData) {
            $caracteristica = Caracteristica::findOrFail($caracteristicaData['id']);
            $caracteristica->update([
                'p_base' => $caracteristicaData['p_base'],
                'bonificador' => $caracteristicaData['bonificador'],
                'b_competencia' => $caracteristicaData['b_competencia'],
                'suma_lado' => $caracteristicaData['suma_lado']
            ]);
        }

        // Procesamos las habilidades
        foreach ($data['habilidades'] as $habilidadData) {
            $habilidad = Habilidad::findOrFail($habilidadData['id']);
            $habilidad->update([
                'bloqueado' => $habilidadData['bloqueado']
            ]);
        }

        // Procesamos los equipamientos
        foreach ($data['equipamientos'] as $equipamientoData) {
            $equipamiento = Equipamiento::findOrFail($equipamientoData['id']);
            $equipamiento->update([
                'habilitado' => $equipamientoData['habilitado']
            ]);
        }

        return response()->json([
            'message' => 'Datos del jugador actualizados correctamente.'
        ], 200);
    }


    // Obtener un jugador específico
    public function show($id)
    {
        $jugador = Jugador::find($id);
        if (!$jugador) {
            return response()->json(['message' => 'Jugador no encontrado'], 404);
        }

        $jugador = Jugador::find($id);
        $jugador['bloqueo'] = Bloqueo::where('id_jugador',$id)->firstOrFail();
        $jugador['hit_point'] = HitPoint::where('id_jugador',$id)->firstOrFail();
        $jugador['esquivar'] = Esquivar::where('id_jugador',$id)->firstOrFail();
        $jugador['ataque'] = Ataque::where('id_jugador',$id)->firstOrFail();
        
        $jugador['caracteristicas'] = Caracteristica::where('id_jugador',$id)->get();
        $jugador['habilidades'] = Habilidad::where('id_jugador',$id)->get();
        $jugador['equipamientos'] = Equipamiento::where('id_jugador',$id)->get();


        return response()->json($jugador, 200);
    }

    // Actualizar un jugador
    public function update(Request $request, $id)
    {
        $jugador = Jugador::find($id);
        if (!$jugador) {
            return response()->json(['message' => 'Jugador no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'alias' => 'sometimes|string|max:255',
            'edad' => 'sometimes|integer',
            'altura' => 'sometimes|numeric',
            'nivel' => 'sometimes|integer',
            'bon_competencias' => 'sometimes|integer',
            'id_usuario' => 'sometimes|integer|exists:usuarios,id',
        ]);

        $jugador->update($validatedData);
        return response()->json($jugador, 200);
    }

    // Eliminar un jugador
    public function destroy($id)
    {
        $jugador = Jugador::find($id);
        if (!$jugador) {
            return response()->json(['message' => 'Jugador no encontrado'], 404);
        }

        $jugador->delete();
        return response()->json(['message' => 'Jugador eliminado con éxito'], 200);
    }
}
