<?php

use App\Http\Controllers\MiControlador;
use Illuminate\Http\Request;
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
//     return $request->user();
// });

Route::get('/cursos/{dni}/{clase?}', [MiControlador::class,"inicial"])->where(['clase' => '[0-4]+', 'dni' => '[a-z]+']);
Route::post('/alumno/{id}', [MiControlador::class,"recuperaAlumno"]);
Route::get('/pruebafaker', [MiControlador::class, "pruebafaker"]);

// Route::get('/cursos/{dni}', function ($dni) {
//     $nota = 10;
//     return response()->json(['curso' => $dni, 'nota' => $nota], 200);
// });