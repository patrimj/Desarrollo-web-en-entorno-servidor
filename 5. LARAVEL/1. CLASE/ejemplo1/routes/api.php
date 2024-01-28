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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/ // lo comentamos 


//RUTAS QUE VOY A PERMITIR

// para que se pueda acceder a la api desde cualquier sitio
Route::get('/cursos/{dni}', function ($dni) {
    $nota =10;//para que devuelva un json
    return response () -> json (['curso'=>$dni,'nota'=>$nota],200); //para que devuelva un json
});

Route :: get ('/cursos/{dni}/{clase?}', [MiControlador::class,"inicial"])-> where ('dni','[0-9]{8}[A-Z]'); 

Route :: post ('/cursos', [MiControlador::class,"recuperarAlumno"]);
