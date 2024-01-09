
<?php
require_once __DIR__.'..\Auxiliar\Conexion.php';
require_once __DIR__.'..\Auxiliar\Factoria.php';
require_once __DIR__.'..\Modelo\Jugador.php';
require_once __DIR__.'..\Modelo\Partida.php';

Class ControladorAdmin{

/*------------------------ FUNCIONES ADMINISTRADOR ------------------------ */

// listar los usuarios 
    public static function listarJugadores() {
        $jugadores = Conexion::jugadores();
        if (is_array($jugadores) && count($jugadores) > 0) {
            $cod = 200;
            $mes = 'Jugadores listados con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Jugadores' => $jugadores
            ];
            echo json_encode($respuesta);
            
        } else {
            $cod = 400;
            $mes = 'No se han encontrado jugadores';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// buscar usuarios
    public static function buscarJugador($id_jugador) {
        $jugador = Conexion::buscarJugador($id_jugador);
        if ($jugador instanceof Jugador) {
            $cod = 200;
            $mes = 'Jugador encontrado con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Jugador' => $jugador
            ];
            echo json_encode($respuesta);
            
        } else {
            $cod = 404;
            $mes = 'No se ha encontrado el jugador';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// registrar usuarios
    public static function registrarUsu($jugador){
        if (Conexion::registrarUsu($jugador)) {
            $cod = 200;
            $mes = 'Usuario registrado con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Jugador' => $jugador
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 400;
            $mes = 'Error al registrar el usuario';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// modificar usuarios
    public static function modificarJugador($jugador){
        if (Conexion::modificarJugador($jugador)) {
            $cod = 200;
            $mes = 'Jugador modificado con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 400;
            $mes = 'Error al modificar el jugador';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// eliminar usuarios
    public static function eliminarJugador($id_jugador){
        if (Conexion::eliminarJugador($id_jugador)) {
            $cod = 200;
            $mes = 'Jugador eliminado con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 400;
            $mes = 'Error al eliminar el jugador';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes
            ];
            echo json_encode($respuesta);
        }
    }

// cambio de contraseña usuarios
    public static function cambiarContrasena($datos){
        $jugador = Factoria::jugadorNuevo($datos ['id_jugador'], null, null, $datos['pssw'], null, null, null);
        if (Conexion::cambiarContrasena($datos ['id_jugador'], $datos['pssw'])) {
            $cod = 200;
            $mes = 'Contraseña modificada con éxito';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            $respuesta = [
                'Codigo' => $cod,
                'Mensaje' => $mes,
                'Jugador' => $jugador
            ];
            echo json_encode($respuesta);
        } else {
            $cod = 400;
            $mes = 'Error al modificar la contraseña del jugador';
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