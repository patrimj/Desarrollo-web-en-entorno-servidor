<?php

use App\Http\Controllers\Controlador1;
use App\Http\Controllers\Controlador2;
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


Route::prefix('admin')->middleware(['mid1','mid2'])->group(function () {
    Route::get('ruta2',[Controlador1::class,'Accion2']);
    Route::get('ruta1',[Controlador1::class,'Accion1'])->middleware('mid3');
});


Route::get('ruta3',[Controlador2::class,'Accion3']);
Route::get('ruta4',[Controlador2::class,'Accion4']);