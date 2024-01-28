<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controladorAlquiler extends Controller{

    public function alquilarCoche (Request $request){ // alquilar coche
        
        try{
            $dni = $request->get("DNI");
            $matricula = $request->get("Matricula");

            $alquileres = DB::select('select * from alquiler where dni = ? and entregado = 0', [$dni]);
            
            $num = count($alquileres);
            
            if($num < 3){
                DB::insert('insert into alquiler (dni, matricula, dias, entregado) values (:dn, :mat, 0, 0)', ['dn' => $dni, 'mat' => $matricula]);
                return response()->json(['mensaje'=>'Registro insertado correctamente'],200);
            }else{
                return response()->json(['mensaje'=>'No se puede alquilar mas de 3 coches'],400);
            }

        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al insertar el registro'],400);
        }
    }

    public function devolverCoche (Request $request){ // entregar coche alquilado
        
        try{
            $dni = $request->get("DNI");
            $matricula = $request->get("Matricula");

            $alquileres = DB::select('select * from alquiler where dni = ? and matricula = ? and entregado = 0', [$dni],[$matricula]);

            if (!$alquileres) {
                return response()->json(['mensaje'=>'No se puede entregar un coche que no se ha alquilado'],400);
            }else{
                $precio = DB::select('select dias * (select precioDia from coches where matricula = ?) from alquiler where DNI = ? and Matricula = ?', [$matricula, $dni, $matricula]);
                
                DB::update('update alquiler set entregado = 1 where dni = ? and matricula = ?', [$dni, $matricula]);
                    return response()->json(['mensaje' => 'Registro modificado correctamente', 'precio' => $precio], 200);

            }
        
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al insertar el registro'],400);
        }
    }

    public function cochera (Request $request){ // coches alquilados
        
        try{
            $dni = $request->get("DNI"); 
            $alquileres = DB::select('select * from alquiler where dni = ? and entregado = 1', [$dni]);
            return response()->json(['alquileres'=>$alquileres],200);
        
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'no se encontraron coches'],400);
        } 
    }

    public function ranking (){ // ranking de coches mas alquilados
        
        try{
            $ranking = DB::select('SELECT Matricula, COUNT(Matricula) AS veces_alquilado FROM alquiler WHERE entregado = 1 GROUP BY Matricula ORDER BY veces_alquilado DESC');
            return response()->json($ranking);

        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al insertar el registro'],400);
        }
    }
}

