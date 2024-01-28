<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Profesor;
use App\Models\Parte;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('profesores', function () {
    //$profesores = Profesor::factory(4)->make(); //Con esto se hacen elementos pero no se almacenan en la base de datos.
    $profesores = Profesor::factory(5)->create();
    return response()->json($profesores);
});


Route::get('partes', function () {
    $partes = Parte::factory(5)->create();
    //$partes = Parte::factory(7)->make();
    return response()->json($partes);
});

//Puestos por el profesor 'id'.
Route::get('puestos/{id}', function (string $id) {
    $profesor = Profesor::find($id);
    if ($profesor) {
        $partes = $profesor->partesPuestos;
        return response()->json($partes);
    }
    else {
        return response()->json(['cod' => 200,'msg' => 'No se encontró el profesor'], 200);
    }
});

//Recibidos por el profesor 'id'.
Route::get('recibidos/{id}', function (string $id) {
    return response()->json(Parte::with('partesRecibidos')->where('idprofesor',$id)->get());
});
