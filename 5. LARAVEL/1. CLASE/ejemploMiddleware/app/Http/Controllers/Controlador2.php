<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controlador2 extends Controller
{
    //
    function __construct()
    {
        $this->middleware(['mid1','mid3'])->except('Accion4');
    }

    function Accion3(Request $request){
        // $nom = $request->get('nombre');
        
        return response()->json(['msg' => 'Accion 3'],200);
    }

    function Accion4(Request $request){
        // $nom = $request->get('nombre');
        
        return response()->json(['msg' => 'Accion 4'],200);
    }
}
