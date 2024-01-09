<?php

require_once __DIR__ . '\..\Databases\Conexion.php';
require_once __DIR__ . '\..\Model\Persona.php';

class ControladorJugador{

/*------------------------ FUNCIONES JUGADOR ------------------------ */

// crear partida
    public static function crearPartida($partida){ 
        if (Conexion::crearPartida($partida)) {
            $cod = 201;
            $mes = 'Partida creada con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Partida' => $partida
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 404;
            $mes = 'No se ha podido crear la partida';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// listar partidas
    static function listarPartidas(){
        $partidas = Conexion::partidas();
        if (is_array($partidas) && count($partidas) > 0) { 
            $cod = 200;
            $mes = 'Partidas listadas con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Partidas' => $partidas
            ];
            echo json_encode($respuesta);
    
        } else {
            $cod = 404;
            $mes = 'No se han encontrado partidas';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// buscar partida
    static function buscarPartida($id) {
        $partida = Conexion::buscarPartida($id);
        if ($partida instanceof Partida) {
            $cod = 200;
            $mes = 'Partida encontrada con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Partida' => $partida
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 404;
            $mes = 'Partida no encontrada';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }
//partida estado  
    public static function partidaTerminada($id_partida, $estado){
        if (Conexion::partidaTerminada($id_partida, $estado)) {
            $cod = 200;
            $mes = 'Partida actualizada con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 404;
            $mes = 'No se ha podido actualizar la partida';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }
// cambiar contraseña
    static function cambiarContrasena($email, $pssw){
        if (Conexion::cambioContrasena($email, $pssw)) {
            $cod = 200;
            $mes = 'Contraseña modificada con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 404;
            $mes = 'No se ha podido modificar la contraseña';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// ranking
    static function ranking(){
        $ranking = Conexion::ranking();
        if (is_array($ranking) && count($ranking) > 0) { 
            $cod = 200;
            $mes = 'Ranking listado con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Ranking' => $ranking
            ];
            echo json_encode($respuesta);
            
        } else {
            $cod = 404;
            $mes = 'No se han encontrado partidas';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }
}
