<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class inicio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{ // verificamos si el usuario existe en la base de datos
        
        $dni = $request->get("DNI");
        $usuario = DB::table('personas')->where('DNI','=',$dni)->get();
        if($usuario->isEmpty()){
            return response()->json(['mensaje'=>'Usuario no encontrado'],400);
        }else{
            return $next($request);// si existe el usuario continua con la peticion
        }
    }
}    

