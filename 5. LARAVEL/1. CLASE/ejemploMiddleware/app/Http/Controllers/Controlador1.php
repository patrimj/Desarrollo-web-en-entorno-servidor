<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controlador1 extends Controller
{
    //
    function Accion1(Request $request){
        // $nom = $request->get('nombre');

        return response()->json(['msg' => 'Accion 1'],200);
    }

    function Accion2(Request $request){
        // $nom = $request->get('nombre');
        
        return response()->json(['msg' => 'Accion 2'],200);
    }
}
