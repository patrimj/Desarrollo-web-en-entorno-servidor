<?php

use App\Http\Controllers\controladorAlquiler;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\controladorUsuarios;
use  App\Http\Controllers\controladorCoche;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('usuario')->group(function () {
    Route::get('/users', function () {
        //rutas crud usuarios
        Route::get('todos',[controladorUsuarios::class,'selecionarUsuario']);
        Route::get('usuario/{dni}',[controladorUsuarios::class,'selecionarUsuarioPorId']);
        Route::post('insertar',[controladorUsuarios::class,'insertarUsuario']);
        Route::put('modificar/{dni}',[controladorUsuarios::class,'modificarUsuario']);
        Route::delete('eliminar/{dni}',[controladorUsuarios::class,'eliminarUsuario']);
    });
})->middleware('inicio'); 

Route::prefix('coche')->group(function () {
    Route::get('/users', function () {
        //rutas crud coches
        Route::get('todos',[controladorCoche::class,'selecionarCoche']);
        Route::get('coche/{Matricula}',[controladorCoche::class,'selecionarCochePorId']);
        Route::post('insertar',[controladorCoche::class,'insertarCoche']);
        Route::put('modificar',[controladorCoche::class,'modificarCoche']);
        Route::delete('eliminar/{matricula}',[controladorCoche::class,'eliminarCoche']);
     
        //rutas alquileres 
        Route::post('alquilar',[controladorAlquiler::class,'alquilarCoche']);
        Route::put('devolver',[controladorAlquiler::class,'devolverCoche']);
        Route::get('ranking',[controladorAlquiler::class,'ranking']);
        Route::get('cochera/{dni}', [controladorAlquiler::class, 'cochera']);
    });
})->middleware('inicio'); 