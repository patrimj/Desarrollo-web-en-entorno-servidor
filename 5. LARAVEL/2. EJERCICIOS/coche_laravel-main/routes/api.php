<?php

use App\Http\Controllers\controladorAlquiler;
use App\Http\Controllers\controladorCoche;
use App\Http\Controllers\controladorPersona;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user()
// });

Route::prefix('usuarios')->group(function () {
    Route::get('/{dni}', [controladorPersona::class, 'seleccionarUsuarioDNI']);
    Route::get('/', [controladorPersona::class, 'seleccionarUsuarios']);
    Route::post('/', [controladorPersona::class, 'crearUsuario']);
    Route::put('/{dni}', [controladorPersona::class, 'modificarUsuario']);
    Route::delete('/{dni}', [controladorPersona::class, 'borrarUsuario']);
});

Route::prefix('coches')->group(function () {
    Route::get('/{matricula}', [controladorCoche::class, 'seleccionarCocheMatricula']);
    Route::get('/', [controladorCoche::class, 'seleccionarCoches']);
    Route::delete('/{matricula}', [controladorCoche::class, 'borrarCoche']);
    Route::put('/{matricula}', [controladorCoche::class, 'modificarCoche']);
    Route::post('/', [controladorCoche::class, 'insertarCoche']);
    Route::put('/modificar_precio/{matricula}', [controladorCoche::class, 'modificarPrecio']);
});

Route::prefix('alquileres')->group(function () {
    Route::post('/solicitar/{dni}', [controladorAlquiler::class, 'comprobacionAlquiler']);
    Route::put('/devolucion', [controladorAlquiler::class, 'devolucionAlquiler']);
    Route::get('/ranking', [controladorAlquiler::class, 'rankingAlquileres']);
});
