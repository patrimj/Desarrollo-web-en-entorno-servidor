<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class controladorCoche extends Controller
{
    //CRUD COCHES CON QB
    public function selecionarCoche() {

        try {
            DB::table('coches') ->get();
            return response()->json(['mensaje'=>'Coche seleccionado'],200);
            
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al seleccionar el coche'],400);
        }
    }    

    public function selecionarCochePorId(Request $request) {
        try {
            DB::table('coches')->select ('select * from coches where Matricula = ?', [$request -> get('Matricula')]);
            //DB::table('coches')->where('Matricula', $request->get('Matricula'))->get();
            return response()->json(['mensaje'=>'Coche seleccionado'],200);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al seleccionar el coche'],400);
        }
    }  

    public function insertarCoche(Request $request) {
        try {
            $matricula = $request->get("Matricula");
            $marca = $request->get("Marca");
            $modelo = $request->get("Modelo");
            $precioDia = $request->get("PrecioDia");

            DB::table('coches')->insert([ // otra manera mas estructurada y visible
                'Matricula' => $matricula,
                'Marca' => $marca,
                'Modelo' => $modelo,
                'PrecioDia' => $precioDia
            ]);

            return response()->json(['mensaje'=>'Coche insertado correctamente'],200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al insertar el coche'],400);
        }
    }   
    public function modificarCoche(Request $request) {
        try {
            $matricula = $request->get("Matricula");
            $marca = $request->get("Marca");
            $modelo = $request->get("Modelo");
            $precioDia = $request->get("PrecioDia");

            DB::table('coches')->update([ // otra manera mas estructurada y visible
                'Matricula' => $matricula,
                'Marca' => $marca,
                'Modelo' => $modelo,
                'PrecioDia' => $precioDia
            ]);
            return response()->json(['mensaje'=>'Coche modificado correctamente'],200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al modificar el coche'],400);
        }
    }
    public function eliminarCoche(Request $request) {
        try {
            DB::table('coches')->delete(['Matricula' => $request-> get ('Matricula')]);
                return response()->json(['mensaje'=>'Coche eliminado correctamente'],200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al eliminar el coche'],400);
        }
    }
}
