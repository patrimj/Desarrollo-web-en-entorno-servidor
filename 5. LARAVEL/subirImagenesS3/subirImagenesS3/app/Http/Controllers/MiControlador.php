<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MiControlador extends Controller
{
    public function cargarImagen(Request $request){

        $messages = [
            'max' => 'El campo se excede del tamaño máximo'
        ];

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);
        if ($validator->fails()){
            return response()->json($validator->errors(),202);
        }
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // dos formas de subirlo

            //1) $path = $file->store('perfiles', 's3'); // 'perfiles' es la carpeta en tu bucket. Este método le asigna un UID a la imagen.

            $path = $file->storeAs('perfiles', $file->getClientOriginalName(), 's3'); //De esta manera lo guardamos con el nombre que se sube.
                                                                                      //Si se sube la foto de perfil una opción es que el nombre del archivo sea el id del usuairo.
            $url = Storage::disk('s3')->url($path);
            return response()->json(['path' => $path, 'url'=> $url],200);
        }

        return response()->json(['error' => 'No se recibió ningún archivo.'], 400);

    }
}
