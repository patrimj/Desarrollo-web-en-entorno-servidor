<?php
require_once __DIR__.'..\Auxiliar\Conexion.php';
require_once __DIR__.'..\Auxiliar\Factoria.php';
require_once __DIR__.'..\Modelo\Jugador.php';
require_once __DIR__.'..\Modelo\Partida.php';

Class Controlador{

/*------------------------ AUTENTICACIÓN ------------------------ */

// inicio de sesion --> para saber si es admin o no

    public static function login($email, $pssw){
        $resultado = Conexion::emailJugador($email, $pssw);
        $jugador = $resultado->fetch_array(); 

        if ($resultado && $resultado->num_rows > 0) {
            $cod = 200;
            $mes = 'Inicio de sesión correcto';
            $inicio_sesion = true;
            $es_admin = self::es_admin($jugador);
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Jugador' => $jugador,
                'Administrador' => $es_admin, // si es admin o no aparecerá  escirto como true o false
                'Inicio_sesion' => $inicio_sesion
            ];
            return $resultado; //devolvera el jugador
            echo json_encode($respuesta);
        } else {
            $cod = 404;
            $mes = 'Inicio de sesión incorrecto';
            $inicio_sesion = false;
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Inicio_sesion' => $inicio_sesion
            ];
            echo json_encode($respuesta);
        }
    }

    public static function es_admin ($jugador){
        $administrador = false;

        if ($jugador->getAdministrador() == 1) {
            $administrador = true;
        }
        return $administrador;
    }

/*------------------------ FUNCIONAMIENTO PARTIDA ------------------------ */  

//actualizar las partidas jugadas
    public static function incrementarPartidasJugadas($id_jugador, $partida){
        if (Conexion::incrementarPartidasJugadas($id_jugador, $partida)) {
            $cod = 200;
            $mes = 'Partidas ganadas actualizadas con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 404;
            $mes = 'No se ha podido actualizar las partidas ganadas';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    
    }

//actualizar las partidas ganadas
    public static function incrementarPartidasGanadas ($id_jugador, $partida){ 
        if (Conexion::incrementarPartidasGanadas($id_jugador, $partida)) {
            $cod = 200;
            $mes = 'Partidas ganadas actualizadas con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 404;
            $mes = 'No se ha podido actualizar las partidas ganadas';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

//partida terminada
    public static function partidaEstado($partida){
        $estado = false;
        if ($partida->getEstado() == 'Acabada Ganada' || $partida->getEstado() == 'Acabada Perdida') {
            $estado = true;
        }
        return $estado;
    }

/*------------------------ FUNCIONAMIENTO TABLEROS ------------------------ */  

//convertir cadenas y strings

    public static function convertirCadena($cadena){
        $array = explode(',', $cadena);
        return $array;
    }

    public static function convertirArray($array){
        $cadena = implode(',', $array);
        return $cadena;
    }
}    
    