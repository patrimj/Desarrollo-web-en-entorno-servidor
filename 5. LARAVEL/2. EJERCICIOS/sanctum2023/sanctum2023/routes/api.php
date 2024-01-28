<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ParteController;
use App\Http\Controllers\API\AuthController;


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
 // si no tienes token no puedes acceder a las rutas
Route::middleware('auth:sanctum')->group( function () {
    Route::get('partes', [ParteController::class,'index'])-> middleware('middlectura'); 
    Route::post('parte', [ParteController::class,'store'])-> middleware('middescritura');
    Route::get('parte/{id}', [ParteController::class,'show'])-> middleware('middlectura');
    Route::put('parte/{id}', [ParteController::class,'update']) -> middleware(['middlectura', 'middescritura']);
    Route::delete('parte/{id}', [ParteController::class,'destroy'])->middleware('middborrado');
});

// no es necesario proteger rutas con token porque no es necesario estar logueado para hacer login o registro
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);

 
Route::get('', function () {
    return response()->json("No autorizado",203);
})->name('nologin'); //con name le damos un nombre a la ruta y asi no es necesario crear una ruta 
