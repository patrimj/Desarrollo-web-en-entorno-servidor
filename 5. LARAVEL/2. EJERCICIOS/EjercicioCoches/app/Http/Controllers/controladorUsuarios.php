<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class controladorUsuarios extends Controller{

    //CRUD USUARIOS SIN QB 
    public function selecionarUsuario() {
        $persona = DB::select('select * from personas');
        return response()->json(['personas'=>$persona],200);
    }

    public function selecionarUsuarioPorId(Request $request) {
        $persona = DB::select('select * from personas where DNI = ?', [$request->get('DNI')]);
        return response()->json(['personas'=>$persona],200);
    }

    public function insertarUsuario(Request $request) {
   
        try {
            DB::insert('insert into personas (DNI, Nombre, Tfno, edad) values (:dn, :nomb, :tlf, :ed)', ['dn' => $request->get('DNI'), 'nomb' => $request->get('Nombre'), 'tlf' => $request->get('Tfno'),'ed' => $request->get('edad')]);
            return response()->json(['mensaje'=>'Registro insertado correctamente'],200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al insertar el registro'],400);
        }
    }

    public function modificarUsuario(Request $request) {
        try { // otra manera mas comoda
            $dni = $request->get("DNI");
            $nombre = $request->get("Nombre");
            $tfno = $request->get("Tfno");
            $edad = $request->get("edad");

            DB::update('update personas set DNI = ? , Nombre = ? , Tfno = ? , edad = ?  where DNI = ?', [$dni,$nombre, $tfno, $edad, $dni]); 
            return response()->json(['mensaje'=>'Registro modificado correctamente'],200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al modificar el registro'],400);
        }
    }
    public function eliminarUsuario(Request $request) {
        try {
            $dni = $request->get("DNI");
            DB::delete('delete from personas where DNI = ?', [$dni]);
            return response()->json(['mensaje'=>'Registro eliminado correctamente'],200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['mensaje'=>'Error al eliminar el registro'],400);
        }
    }
}    