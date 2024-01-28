<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;


class controladorPersona extends Controller
{
    static function existeUsuario($dni) {
        $query = DB::select('select * from personas where DNI = ?', [$dni]);
        if (empty($query[0])) {
            return false;
        }else {
            return true;
        }
    }
    function seleccionarUsuarioDNI($dni) {
        $query = DB::select('select * from personas where DNI = ?', [$dni]);
        $persona = new Persona($query[0]->DNI, $query[0]->Nombre, $query[0]->Tfno, $query[0]->edad);
        return response()->json(['persona' => $persona],200);
    }

    function seleccionarUsuarios() {
        $query = DB::select('select * from personas');
        $data = Array();
        foreach ($query as $objeto) {
            $persona = new Persona($objeto->DNI, $objeto->Nombre, $objeto->Tfno, $objeto->edad);
            array_push($data, $persona);
        }
        return response()->json(['Datos',$data],200);
     }


    function crearUsuario(Request $request) {
        try {
            DB::insert('insert into personas (DNI, Nombre, Tfno, edad) values (?, ?, ?, ?)', 
            [$request->get('dni'), $request->get('nombre'), $request->get('tfno'), $request->get('edad')]);
            return response()->json(['mensaje'=>'Registro insertado correctamente'],200);
        }
        catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Clave duplicada'],202);
        }
    }
    
    function modificarUsuario(Request $request, $dni) {
        try {
            $afectadas = DB::update('update personas set Nombre = ?, Tfno = ?, edad = ? where DNI = ?', 
            [$request->get('nombre'), $request->get('tfno'), $request->get('edad'), $dni]);
            return response()->json(['Filas afectadas'=>$afectadas], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error de update'], 202);
        }
    }

    function borrarUsuario($dni) {
        try {
            $borradas = DB::delete('delete from personas where DNI = ?', [$dni]);
            return response()->json(['Registros borrados'=>$borradas], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = $e->getMessage();
            return response()->json([$mensaje], 202);
        }
    }

}

