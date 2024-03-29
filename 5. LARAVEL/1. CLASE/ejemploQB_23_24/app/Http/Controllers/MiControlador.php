<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiControlador extends Controller
{
    public function listar() {
        //************* Sin QueryBuilder ******************
        // a) Select sencilla con un valor.
        $personas = DB::select('select * from personas where DNI = ? and edad < ?', ['1A', 18]); // la libreria DB es de Laravel, el dni busca 1A y edad menor de 18
        //b) Usando un parámetro con nombre.
        $personas = DB::select('select * from personas where DNI = :dn', ['dn' => '4D']); // en lugar de ? un nombre, para no perdertr
        //c) Consulta de varias tablas.
         $quer = 'select * from personas, propiedades, coches'
           . ' where propiedades.DNI = personas.DNI '
           . 'AND propiedades.Matricula = coches.Matricula And personas.DNI = ?';
        $personas = DB::select($quer,['1A']);
        /*
         * Otros ejemplos sin QB:
         */
        try {
             DB::insert('insert into personas (DNI, Nombre, Tfno, edad) values (?, ?, ?, ?)', ['007', 'Naiden', '1234', 36]);
        //     /* $afectadas = \DB::update('update personas set Tfno = '100' where DNI = ?', ['3C'])
        //      * $borradas = \DB::delete('delete from personas');
        //      */
            return response()->json(['mensaje'=>'Registro insertado correctamente'],200);
         } catch (\Illuminate\Database\QueryException $e) {
             return response()->json(['mensaje'=>'Clave duplicada'],202);
        }


        //************* Con Query Builder ****************
        //Dirección de interés para Query Builder: https://laravel.com/docs/10.x/queries
        //a) El equivalente de una select *.
         $personas = DB::table('personas')->get(); // es lo mismo que select * from personas
         return $personas [2]->Nombre;//para sacar sus atributos
        //b) Select con condiciones
         $personas = DB::table('personas')
         ->select('DNI', 'Nombre', 'Tfno', 'edad') /// si quiero unos campos concretos
         ->where('DNI', '=', '5E')
         ->orderBy('edad', 'desc')
         ->get(); 
        //c) Selección con opciones AND y OR --> whereBetween,whereNotBetween,whereIn,whereNotIn,whereNull,whereNotNull,whereDate,whereMonth,whereDay,whereYear,whereTime,whereColumn,whereRaw, orWhereRaw, havingRaw, orHavingRaw, orderByRaw, groupByRaw
        // $personas = DB::table('personas')
        //  ->select('DNI','Nombre','Tfno','edad')
        //  ->whereBetween('edad', [35, 40])
        //  ->orwhere('nombre','Alicia')
        //  ->orderBy('edad','desc')
        //  ->get();
        //d) Selección haciendo join de varias tablas.
        // $personas = DB::table('personas')
        //         ->join('propiedades', 'propiedades.DNI', '=', 'personas.DNI')
        //         ->join('coches', 'coches.Matricula', '=', 'propiedades.Matricula')
        //         ->select('personas.DNI', 'Nombre', 'edad', 'Marca', 'Modelo')
        //         ->where('nombre','Alicia')
        //         ->get();

        ///Otras opciones con QB:
        // try {
        //     DB::table('personas')->insert(
        //         ['DNI' => '2034T', 'Nombre' => 'Yoda', 'Tfno' => '435', 'edad' => 10]
        //         );
        //     return response()->json(['mensaje'=>'Registro insertado correctamente'],200);
        // }
        // catch(\Illuminate\Database\QueryException $e){
        //     return response()->json(['mensaje'=>'Clave duplicada'],202);
        // }

        // $personas = DB::table('personas')
        //  ->where('DNI', '1A')
        //  ->update(['Tfno' => '16']);
        // $personas = DB::table('personas')->where('DNI', '=', '007')->delete();
        // $personas = DB::table('personas')->truncate(); // limpia la bbdd entera

        //************* EJERCICIOS CLASE ****************

        //CRUD -> USUARIOS -> DB::


        $datos = [
            'pers' => $personas
        ];

        //return view('listado', $datos);
        return response()->json($datos,200);
    }
}
