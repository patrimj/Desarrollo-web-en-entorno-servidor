<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiControlador extends Controller
{
    function inicial ($dni,$clase = null){
        $nota =10;//para que devuelva un json
        return response () -> json (['curso'=>$dni,'nota'=>$nota],200); //para que devuelva un json
        
    }
    function recuperarAlumno(Request $request, $id){ // en el body del post  con nombre y midiclorianos {"nombre": "Carlos", "midiclorianos": 1000}
        $nom = $request->get('nombre');
        $mid=  $request->get('midiclorianos');
        return response () -> json (['hola'=>$nom,'nivel'=>$mid, 'id'=>$id],201); //para que devuelva un json
    }
}
// Escribe un programa que simule el mecanismo de devolución de monedas de una máquina expendedora. El programa preguntará una cantidad de dinero y calculará la cantidad de monedas necesarias para dar esa cantidad. Por ejemplo, 3,47 € serían 1 moneda de 2€, 1 de 1€, 2 de 20cts, 1 de 5cts y 1 de 2 cts.