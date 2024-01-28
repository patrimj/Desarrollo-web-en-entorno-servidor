<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class MiControlador extends Controller
{
    function inicial($dni, $clase=null){
        $nota = 10;
        return response()->json(['curso' => $dni, 'clase' => $clase, 'nota' => $nota], 200);
    }

    function recuperaAlumno(Request $request, $id){
        $nom = $request->get('nombre');
        $mid = $request->get('midiclorianos');
        return response()->json(['Hola' => $nom, 'nivel' => $mid, 'id' => $id], 201);
    }

    //https://fakerphp.github.io/
    public function pruebaFaker() {
        $fak = \Faker\Factory::create('es_ES');
        // $fak = \Faker\Factory::create();
        // $fak = \Faker\Factory::create('fr_FR');
         $datos = [
            'idUnico' => $fak->unique()->randomDigit(),
            'nombreCompleto: ' => $fak->name,
            'nombre' => $fak->firstName,
            'apellidos' => $fak->lastName,
            'dirección' => $fak->address,
            'texto' => $fak->text,
            'email' => $fak->email,
            'ciudad' => $fak->city,
            'comp: ' => $fak->company,
            'claveAleatoria' => $fak->password,
             'DNI' => $fak->dni
        ];

        $p = new Persona($datos['nombre'],$datos['apellidos']);
        return response()->json(['pers' => $p],200);
        //Dirección de interés para faker: https://code.tutsplus.com/es/tutorials/using-faker-to-generate-filler-data-for-automated-testing--cms-26824
        //return response()->json($datos,200,['Content-Type'=>'application/json'],JSON_UNESCAPED_UNICODE);
        //return response()->json($datos,200,[],JSON_UNESCAPED_UNICODE);
    }
}
