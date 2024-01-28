<?php

namespace App\Http\Controllers;

use App\Models\Coche;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controladorCoche extends Controller
{

    static function existeCocheMatricula($matricula)
    {
        $coche = DB::table('coches')->where('matricula', '=', $matricula)->get();
        if (empty($coche[0])) {
            return false;
        } else {
            return true;
        }
    }
    function seleccionarCocheMatricula($matricula)
    {
        $query = DB::table('coches')
            ->where('matricula', '=', $matricula)
            ->get();
        $coche = new Coche($query[0]->Matricula, $query[0]->Marca, $query[0]->Modelo, $query[0]->precio_dia);
        return response()->json(['coche' => $coche], 200);
    }

    function seleccionarCoches()
    {
        $query = DB::table('coches')->get();
        $datos = array();
        foreach ($query as $objeto) {
            $coche = new Coche($objeto->Matricula, $objeto->Marca, $objeto->Modelo, $objeto->precio_dia);
            array_push($datos, $coche);
        }
        return response()->json(['Coches' => $datos], 200);
    }

    function borrarCoche($matricula)
    {
        try {
            $afectadas = DB::table('coches')->where('matricula', '=', $matricula)->delete();

            return response()->json(['filas borradas' => $afectadas], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = $e->getMessage();
            return response()->json(['mensaje' => $mensaje], 202);
        }
    }

    function modificarCoche(Request $request, $matricula)
    {
        try {
            DB::table('coches')
                ->where('matricula', '=', $matricula)
                ->update(['marca' => $request->get('marca'), 'modelo' => $request->get('modelo'), 'precio_dia' => $request->get('precio_dia')]);
            return response()->json(['mensaje' => 'Update correcto'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje' => 'Error update'], 202);
        }
    }
    function insertarCoche(Request $request)
    {
        try {
            DB::table('coches')->insert(['matricula' => $request->get('matricula'), 'marca' => $request->get('marca'), 'modelo' => $request->get('modelo'), 'precio_dia' => $request->get('precio_dia')]);
            return response()->json(['mensaje' => 'Insert correcto'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje' => 'Error insert'], 202);
        }
    }

    function modificarPrecio(Request $request, $matricula)
    {
        if (self::existeCocheMatricula($matricula) && intval($request->get('precio_dia')) > 0) {
            try {
                DB::table('coches')
                    ->where('matricula', '=', $matricula)
                    ->update(['precio_dia' => $request->get('precio_dia')]);
                return response()->json(['mensaje' => 'precio modificado']);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['mensaje' => 'Error update'], 202);
            }
        }else {
            return response()->json(['mensaje'=> 'modificiacion no posible'], 202);
        }
    }
    
}
