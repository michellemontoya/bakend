<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AtaqueController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\HabilidadController;
use App\Http\Controllers\EquipamientoController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\SalaJugadorController;
use App\Http\Controllers\CaracteristicaController;
use App\Http\Controllers\BloqueoController;
use App\Http\Controllers\HitPointController;
use App\Http\Controllers\EsquivarController;


// Rutas para UsuarioController
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
Route::post('/usuarios/verificar', [UsuarioController::class, 'verificarUsuario']);

// Rutas para AtaqueController
Route::get('/ataques', [AtaqueController::class, 'index']);
Route::post('/ataques', [AtaqueController::class, 'store']);
Route::get('/ataques/{id}', [AtaqueController::class, 'show']);
Route::put('/ataques/{id}', [AtaqueController::class, 'update']);
Route::delete('/ataques/{id}', [AtaqueController::class, 'destroy']);

// Rutas para JugadorController
Route::get('/jugadores', [JugadorController::class, 'index']);
Route::get('/jugadores/{id}', [JugadorController::class, 'show']);
Route::get('/cantidad/jugadores', [JugadorController::class, 'cantidadJugadores']);
Route::put('/jugadores/{id}', [JugadorController::class, 'update']);
Route::delete('/jugadores/{id}', [JugadorController::class, 'destroy']);

Route::put('/jugadores/actualizar/datos', [JugadorController::class, 'actualizarDatos']);
Route::put('/jugadores/actualizar/datos/otros', [JugadorController::class, 'actualizarDatosOtros']);

Route::post('/jugadores/conocidos/datos', [JugadorController::class, 'jugadoresConocidos']);


// Rutas para HabilidadController
Route::get('/habilidades', [HabilidadController::class, 'index']);
Route::post('/habilidades', [HabilidadController::class, 'store']);
Route::get('/habilidades/{id}', [HabilidadController::class, 'show']);
Route::put('/habilidades/{id}', [HabilidadController::class, 'update']);
Route::delete('/habilidades/{id}', [HabilidadController::class, 'destroy']);

// Rutas para EquipamientoController
Route::get('/equipamientos', [EquipamientoController::class, 'index']);
Route::post('/equipamientos', [EquipamientoController::class, 'store']);
Route::get('/equipamientos/{id}', [EquipamientoController::class, 'show']);
Route::put('/equipamientos/{id}', [EquipamientoController::class, 'update']);
Route::delete('/equipamientos/{id}', [EquipamientoController::class, 'destroy']);

// Rutas para SalaController
Route::get('/salas', [SalaController::class, 'index']);
Route::post('/salas', [SalaController::class, 'store']);
Route::get('/salas/{id}', [SalaController::class, 'show']);
Route::put('/salas/{id}', [SalaController::class, 'update']);
Route::delete('/salas/{id}', [SalaController::class, 'destroy']);

// Rutas para SalaJugadorController
Route::get('/salas_jugadores', [SalaJugadorController::class, 'index']);
Route::post('/salas_jugadores', [SalaJugadorController::class, 'store']);
Route::get('/salas_jugadores/{id}', [SalaJugadorController::class, 'show']);
Route::put('/salas_jugadores/{id}', [SalaJugadorController::class, 'update']);
Route::delete('/salas_jugadores/{id}', [SalaJugadorController::class, 'destroy']);
Route::get('/jugadores/salas/{idSala}', [SalaJugadorController::class, 'obtenerJugadoresPorSala']);


// Rutas para CaracteristicaController
Route::get('/caracteristicas', [CaracteristicaController::class, 'index']);
Route::post('/caracteristicas', [CaracteristicaController::class, 'store']);
Route::get('/caracteristicas/{id}', [CaracteristicaController::class, 'show']);
Route::put('/caracteristicas/{id}', [CaracteristicaController::class, 'update']);
Route::delete('/caracteristicas/{id}', [CaracteristicaController::class, 'destroy']);

// Rutas para BloqueoController
Route::get('/bloqueos', [BloqueoController::class, 'index']);
Route::post('/bloqueos', [BloqueoController::class, 'store']);
Route::get('/bloqueos/{id}', [BloqueoController::class, 'show']);
Route::put('/bloqueos/{id}', [BloqueoController::class, 'update']);
Route::delete('/bloqueos/{id}', [BloqueoController::class, 'destroy']);

// Rutas para HitPointController
Route::get('/hitpoints', [HitPointController::class, 'index']);
Route::post('/hitpoints', [HitPointController::class, 'store']);
Route::get('/hitpoints/{id}', [HitPointController::class, 'show']);
Route::put('/hitpoints/{id}', [HitPointController::class, 'update']);
Route::delete('/hitpoints/{id}', [HitPointController::class, 'destroy']);

// Rutas para EsquivarController
Route::get('/esquivar', [EsquivarController::class, 'index']);
Route::post('/esquivar', [EsquivarController::class, 'store']);
Route::get('/esquivar/{id}', [EsquivarController::class, 'show']);
Route::put('/esquivar/{id}', [EsquivarController::class, 'update']);
Route::delete('/esquivar/{id}', [EsquivarController::class, 'destroy']);
