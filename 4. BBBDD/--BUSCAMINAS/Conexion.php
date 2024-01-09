<?php
require 'Partida.php';
require 'Constantes.php';

class Conexion{

    static $conexion;

    // CONECTAMOS
    public static function conectar()
    {
        if (!self::$conexion) {
            self::$conexion = mysqli_connect(Constantes::$host, Constantes::$user, Constantes::$contra, Constantes::$name);
            if (!self::$conexion) {
                die();
            }
        }
        return self::$conexion;
    }
    // DESCONECTAMOS
    public static function desconectar()
    {
        mysqli_close(self::$conexion);
    }
    //VERIFICAMOS EMAIL Y CONTRASEÑA DEL JUGADOR
    public static function seleccionarPersona($email,$pass){
        if (self::conectar()==0){
            $consulta = "SELECT * FROM personas WHERE email = ? AND pass = ?";
            $stmt = mysqli_prepare(self::$conexion, $consulta);
            mysqli_stmt_bind_param($stmt, "ss", $email,$pass);
            mysqli_stmt_execute($stmt);
            $correcto = [];
            $correcto_query = mysqli_stmt_get_result($stmt);
            if ($fila = mysqli_fetch_array($correcto_query)) {
                $p = new Partida($fila["ID"], $fila["Usuario"], $fila["tablerooculto"], $fila["tablerojugador"], $fila["finalizada"]);
                $correcto[] = $p;
                self::desconectar();
                return ($fila['id']);
            }else {
                self::desconectar();
                return 0;
            }
        }
        else {
            return -1; //conexión falla.
        }
        
    }
    //SEGUN EL ID LE DAMOS PARTIDA
    public static function getPartida($idUsuario){
        if (self::conectar() == 0) {
            $consulta = "SELECT * FROM partida WHERE usuario = ?";
            $stmt = mysqli_prepare(self::$conexion, $consulta);
            mysqli_stmt_bind_param($stmt, "i", $idUsuario);
            mysqli_stmt_execute($stmt);
            $correcto = [];
            $correcto_query = mysqli_stmt_get_result($stmt); // nos devuelve el id del usuario y si hay damos una partida
            
            if ($fila = mysqli_fetch_array($correcto_query)) {
                $partida = [
                    'id' => $fila['id'],
                    'usuario' => $fila['usuario'],
                    'tablerooculto' => $fila['tablerooculto'],
                    'tablerojugador' => $fila['tablerojugador'],
                    'finalizada' => $fila['finalizada']
                ];
                self::desconectar();
                return $partida;
            }else {
                self::desconectar();
                return 0;
            }
        }else {
            return -1; //conexión falla.
        }
    }
    //ACTUALIZAMOS PARTIDA
    public static function insertarPartida($idUsuario, $partida) {
        if (self::conectar() == 0) {
            ///convertimos el objeto para la bbdd
            $tableroOculto = json_encode($partida->tableroOculto);
            $tableroJugador = json_encode($partida->tableroJugador);
    
            $consulta = "INSERT INTO partida (usuario, tablerooculto, tablerojugador, finalizada) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare(self::$conexion, $consulta);
            $finalizada = $partida->finalizada ? 1 : 0;
    
            mysqli_stmt_bind_param($stmt, "isss", $idUsuario, $tableroOculto, $tableroJugador, $finalizada);
            mysqli_stmt_execute($stmt);
    
            self::desconectar();
        }else {
            return -1; //conexión falla.
        }
    }
    
}

