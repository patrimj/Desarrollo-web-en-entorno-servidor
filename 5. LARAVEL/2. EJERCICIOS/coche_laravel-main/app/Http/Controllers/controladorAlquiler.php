<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class controladorAlquiler extends Controller
{
    function numeroCochesAlquilado($dni) {
        $num = DB::table('propiedades')->where('DNI', '=', $dni)->where('entregado', '=', 1)->get()->count();
        return $num;
    }

    function cocheYaAlquilado($matricula, ) {
        $alquilado = DB::table('propiedades')->where('matricula', '=', $matricula)->where('entregado', '=', 1)->get();
        if (empty($alquilado[0])) {
            return false;
        }else {
            return true;
        }
    }
    function cocheYaAlquilado2($matricula, $dni) {
        $alquilado = DB::table('propiedades')
        ->where('matricula', '=', $matricula)
        ->where('entregado', '=', 1)
        ->where('dni', '=', $dni)
        ->get();
        if (empty($alquilado[0])) {
            return false;
        }else {
            return true;
        }
    }
    function comprobacionAlquiler(Request $request, $dni) {
        if (!controladorCoche::existeCocheMatricula($request->get('matricula'))) {
            return response()->json(['mensaje' => 'Coche no existe'], 202);
        }else {
            if($this->numeroCochesAlquilado($dni) < 2 && $this->cocheYaAlquilado($request['matricula']) == false) {
                DB::table('propiedades')
                ->insert(['DNI' => $dni,'matricula' => $request->get('matriucla'), 'dias_alquilado' => $request->get('dias_alquilado'), 'entregado' => 1]);
                $precio = DB::table('coches')->where('matricula', '=', $request->get('matricula'))->get('precio_dia');
                $total = $precio[0]->precio_dia * $request->get('dias_alquilado');
                return response()->json(['mensaje' => 'Insert correcto',
                                         'precio' => $total.'€'], 200);
            }else {
                return response()->json(['mensaje' => 'Alquiler no disponible'], 202);
            }
        }
    }

    function devolucionAlquiler(Request $request) {
        if (!controladorCoche::existeCocheMatricula($request->get('matricula')) || !controladorPersona::existeUsuario($request->get('dni'))) {
            return response()->json(['mensaje' => 'Devolucion no posible'], 202);
        }else {
            if($this->cocheYaAlquilado2($request->get('matricula'), $request->get('dni'))) {
                DB::table('propiedades')
                ->where('matricula', '=', $request->get('matricula'))
                ->where('dni', '=', $request->get('dni'))
                ->update(['entregado' => 0]);
                $precio = DB::table('coches')->where('matricula', '=', $request->get('matricula'))->get('precio_dia');
                $total = $precio[0]->precio_dia * $request->get('dias_alquilado');
                return response()->json(['mensaje' => 'Devolucion correcta', 'Precio: ' => $total], 200);
            }else {
                return response()->json(['mensaje' => 'Devolucion no posible'], 202);
            }
        }   
    }

    function rankingAlquileres() {
        // https://laravel.com/docs/10.x/queries
        $query = DB::table('propiedades')
        ->select(DB::raw('COUNT(*) as total'), 'Matricula')
        ->groupBy('Matricula')
        ->get();

        $datos = array();
        foreach ($query as $objeto) {
            array_push($datos, ['Matricula' => $objeto->Matricula]);
        }
        return response()->json(['Ranking' => $datos], 200);
    }
}
