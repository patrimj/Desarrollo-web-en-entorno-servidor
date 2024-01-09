<?php

require_once 'Constantes.php';
require_once 'Factoria.php';

class Conexion{

    public static $conexion;

/*------------------------ CONEXION Y DESCONEXION BBDD ------------------------ */

    public static function conectar(){ 
        try {
            self::$conexion = new mysqli(Constantes::$host, Constantes::$user, Constantes::$psswd, Constantes::$bdName);
        } catch (Exception $exception) {//si no se puede conectar a la base de datos
            return 'Error al conectar con la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        } finally {
            return self::$conexion;
        }
    }     
     
    public static function desconectar(){
        self::$conexion->close();
    }

/*------------------------ AUTENTIFICARSE ------------------------ */

    //login
    public static function emailJugador($email, $pssw){ // [SELECT] --> [GET]
        self::$conexion = self::conectar();
        $sql = "SELECT * FROM ".Constantes::$tablaJugador ."  WHERE email = ? AND pssw = ?"; 
        $stmt = self::$conexion->prepare($sql); 
        try{
            $stmt->bind_param('ss', $email, $pssw);//asigna el parametro a la consulta que es el email y la contraseña
            $stmt->execute();
            $resultado = $stmt->get_result();
            $jugadores = [];

            while ($fila = $resultado->fetch_array()) { 
                $jugador = Factoria::jugadorNuevo(
                    $fila['id_jugador'], 
                    $fila['nombre'],
                    $fila['email'], 
                    $fila['pssw'], 
                    $fila['partidas_jugadas'], 
                    $fila['partidas_ganadas'], 
                    $fila['administrador']); // creamos un nuevo jugador con los datos de la base de datos, asignando cada dato a su hueco en el constructor
                $jugadores[] = $jugador;
            }
            $resultado->free_result(); 
            return $jugador;
        }catch  (Exception $exception) {
            return 'Error al obtener el jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }   
    }

/*------------------------ FUNCIONES ADMINISTRADOR [CRUD JUGADOR]------------------------ */

    // listar los usuarios de la bbdd
       public static function jugadores() { // [SELECT] --> [GET]
        self::$conexion = self::conectar();
        $sql ="SELECT * FROM ".Constantes::$tablaJugador; 
        $stmt = self::$conexion->prepare($sql); //no hace falta asignar el parametro a la consulta porque no hay parametros
        
        try {
            $stmt->execute();
            $resultado = $stmt->get_result();
            $jugadores = []; // crreamos un array vacío para almacenar los jugadores

            while ($fila = $resultado->fetch_array()) { 
                $jugador = Factoria::jugadorNuevo(
                    $fila['id_jugador'], 
                    $fila['nombre'],
                    $fila['email'], 
                    $fila['pssw'], 
                    $fila['partidas_jugadas'], 
                    $fila['partidas_ganadas'], 
                    $fila['administrador']);
                $jugadores[] = $jugador; // añadimos el jugador al array de jugadores
            }
            $resultado->free_result(); 
            return $jugadores;
        }catch  (Exception $exception) {
            return 'Error al obtener los jugadores de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }   
    }

    //buscar usuario por id
    public static function buscarJugador($id_jugador){ // [SELECT] --> [GET]
        self::$conexion = self::conectar();
        $sql = "SELECT * FROM ".Constantes::$tablaJugador ." WHERE id_jugador = ?"; 
        $stmt = self::$conexion->prepare($sql); 
        
        try {
            $stmt->bind_param('i', $id_jugador); 
            $stmt->execute();
            $resultado = $stmt->get_result();
            $jugadores = []; 

            while ($fila = $resultado->fetch_array()) { 
                $jugador = Factoria::jugadorNuevo(
                    $fila['id_jugador'], 
                    $fila['nombre'],
                    $fila['email'], 
                    $fila['pssw'], 
                    $fila['partidas_jugadas'], 
                    $fila['partidas_ganadas'], 
                    $fila['administrador']);
                $jugadores[] = $jugador; 
            }
            $resultado->free_result(); 
            return $jugadores;
        }catch  (Exception $exception) {
            return 'Error al obtener el jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }   
    }

    // registrar usuarios
    public static function registrarUsu($jugador){ // [INSERT] --> [POST]
        self::$conexion = self::conectar();
        $sql = "INSERT INTO ".Constantes::$tablaJugador ." (nombre, pssw, email, partidas_jugadas, partidas_ganadas, administrador) VALUES (?, ?, ?, ?, ?, ?)";
    
        $stmt = self::$conexion->prepare($sql);
    
        try{
            $nombre = $jugador->getNombre();
            $email = $jugador->getEmail();
            $pssw = $jugador->getPssw();
            $partidas_jugadas = $jugador->getPartidas_jugadas();
            $partidas_ganadas = $jugador->getPartidas_ganadas();
            $administrador = $jugador->getAdministrador();
            $stmt->bind_param('sssiii', $nombre, $pssw, $email, $partidas_jugadas, $partidas_ganadas, $administrador);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return $jugador;
        }catch  (Exception $exception) {
            return 'Error al registrar un nuevo usuario : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }
    }

        // modificar usuarios
        public static function modificarJugador($jugador){ // [UPDATE] --> [PUT]
            self::$conexion = self::conectar();
            $sql = "UPDATE ".Constantes::$tablaJugador ." SET nombre=?, pssw=?, email=?, partidas_jugadas=?, partidas_ganadas=?, administrador=? WHERE id_jugador=?";
            
            $stmt = self::$conexion->prepare($sql);
    
            try {
                $id_jugador = $jugador->getIdJugador();
                $nombre = $jugador->getNombre();
                $pssw = $jugador->getPssw();
                $email = $jugador->getEmail();
                $partidas_jugadas = $jugador->getPartidas_jugadas();
                $partidas_ganadas = $jugador->getPartidas_ganadas();
                $administrador = $jugador->getAdministrador();
               
                $stmt->bind_param('issssi', $id_jugador, $nombre, $pssw,$email, $partidas_jugadas, $partidas_ganadas,$administrador);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $resultado->free_result();
            }catch  (Exception $exception) {
                return 'Error al modificar el jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
            }finally{   
                self::desconectar();
            }
        }   


    // eliminar usuarios
    public static function eliminarJugador($id_jugador){ // [DELETE] --> [DELETE]
        self::$conexion = self::conectar();
        $sql = "DELETE FROM  ".Constantes::$tablaJugador ." WHERE id_jugador=?";
       
        $stmt = self::$conexion->prepare($sql);
        try{
            $stmt->bind_param('i', $id_jugador);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return 'jugador eliminado con exito';
        }catch  (Exception $exception) {
            return 'Error al eliminar el jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }
    }

    // cambiar contraseña del usuario
    public static function cambiarContrasena($id_jugador, $pssw){ // [UPDATE] --> [PUT]
        self::$conexion = self::conectar();
        $sql = "UPDATE  ".Constantes::$tablaJugador ." SET pssw=? WHERE id_jugador=?";
        $stmt = self::$conexion->prepare($sql);
        try{
            $stmt->bind_param('si', $pssw, $id_jugador);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return 'contraseña cambiada con exito';
        }catch  (Exception $exception) {    
            return 'Error al cambiar la contraseña del jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }
    }

/*------------------------ FUNCIONES JUGADOR [CRUD PARTIDA]------------------------ */

// crear partida
    public static function crearPartida($partida){ // [INSERT] --> [POST]
        self::$conexion = self::conectar();
        $sql = "INSERT INTO  ".Constantes::$tablaPartida ." (id_jugador, tablero_oculto, tablero_visible, estado_partida) VALUES (?, ?, ?, ?)";
        $stmt = self::$conexion->prepare($sql);
        try{
            $id_jugador = $partida->getId_jugador();
            $tablero_oculto = $partida->getTablero_oculto();
            $tablero_visible = $partida->getTablero_visible();
            $estado = $partida->getEstado();

            $stmt->bind_param('isss', $id_jugador, $tablero_oculto, $tablero_visible, $estado);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return $partida;
        }catch  (Exception $exception) {
            return 'Error al crear una nueva partida : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }
    }

    //partidas
    public static function partidas() { // [SELECT] --> [GET]
        self::$conexion = self::conectar();
        $sql = "SELECT * FROM  ".Constantes::$tablaPartida;
        $stmt = self::$conexion->prepare($sql); 
            
        try {
            $stmt->execute();
            $resultado = $stmt->get_result();
            $partidas = array(); 
    
            while ($fila = $resultado->fetch_array()) { 
                $partida = Factoria::partidaNueva(
                    $fila['id_partida'], 
                    $fila['id_jugador'], 
                    $fila['tablero_oculto'], 
                    $fila['tablero_visible'], 
                    $fila['estado']); 
                $partidas[] = $partida; 
            }
            $resultado->free_result(); 
            return $partidas;
        }catch  (Exception $exception) {
            return 'Error al obtener las partidas de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }    
    }

    //buscar partida por id
    public static function buscarPartida($id_partida){ // [SELECT] --> [GET]
        self::$conexion = self::conectar();
        $sql = "SELECT * FROM  ".Constantes::$tablaPartida ." WHERE id_partida = ?";
        $stmt = self::$conexion->prepare($sql); 
        
        try {
            $stmt->bind_param('i', $id_partida);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $partidas = array(); 

            while ($fila = $resultado->fetch_array()) { 
                $partida = Factoria::partidaNueva(
                    $fila['id_partida'], 
                    $fila['id_jugador'], 
                    $fila['tablero_oculto'], 
                    $fila['tablero_visible'], 
                    $fila['estado']);; 
                $partidas[] = $partida; 
            }
            $resultado->free_result(); 
            return $partidas;
        }catch  (Exception $exception) {
            return 'Error al obtener la partida de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }    
    }

    //partida terminada
    public static function partidaTerminada($id_partida, $estado){ // [UPDATE] --> [PUT]
        self::$conexion = self::conectar();
        $sql = "UPDATE  ".Constantes::$tablaPartida ." SET estado=? WHERE id_partida=?";
        $stmt = self::$conexion->prepare($sql);
        try{
            $stmt->bind_param('ii', $estado, $id_partida);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return 'partida terminada con exito';
        }catch  (Exception $exception) {
            return 'Error al terminar la partida de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar(); 
        }
    }

    //cambiar contraseña
    public static function cambioContrasena($email, $pssw){ // [UPDATE] --> [PUT]
        self::$conexion = self::conectar();
        $sql = "UPDATE  ".Constantes::$tablaJugador ." SET pssw=? WHERE email=?";
        $stmt = self::$conexion->prepare($sql);
        try{
            $stmt->bind_param('ss', $pssw, $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return 'contraseña cambiada con exito';
        }catch  (Exception $exception) {
            return 'Error al cambiar la contraseña del jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }
    }

    //solicitar ranking
    public static function ranking () { // [SELECT] --> [GET]
        self::$conexion = self::conectar(); 
        $sql = "SELECT * FROM  ".Constantes::$tablaJugador ." ORDER BY partidas_ganadas DESC";
        $stmt = self::$conexion->prepare($sql); 
        
        try {
            $stmt->execute();
            $resultado = $stmt->get_result();
            $jugadores = []; 

            while ($fila = $resultado->fetch_array()) { 
                $jugador = Factoria::jugadorNuevo(
                    $fila['id_jugador'], 
                    $fila['nombre'],
                    $fila['email'], 
                    $fila['pssw'], 
                    $fila['partidas_jugadas'], 
                    $fila['partidas_ganadas'], 
                    $fila['administrador']);
                $jugadores[] = $jugador; 
            }
            $resultado->free_result(); 
            return $jugadores;
        }catch  (Exception $exception) {
            return 'Error al obtener los jugadores de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar();
        }    
    }

    /*------------------------ FUNCIONAMIENTO PARTIDA ------------------------ */
    
    //actualizar las partidas jugadas
    public static function incrementarPartidasJugadas ($id_jugador, $partida){ // [UPDATE] --> [PUT]
        self::$conexion = self::conectar();
        $sql = "UPDATE  ".Constantes::$tablaJugador ." SET partidas_jugadas=? WHERE id_jugador=?";
        $stmt = self::$conexion->prepare($sql);
        try{
            $stmt->bind_param('ii', $id_jugador, $partida);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return 'partidas jugadas incrementadas con exito';
        }catch  (Exception $exception) {
            return 'Error al incrementar las partidas jugadas del jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar(); 
        }
    }
    //actualizar las partidas ganadas
    public static function incrementarPartidasGanadas ($id_jugador, $partida){ // [UPDATE] --> [PUT]
        self::$conexion = self::conectar();
        $sql = "UPDATE  ".Constantes::$tablaJugador ." SET partidas_ganadas=? WHERE id_jugador=?";
        $stmt = self::$conexion->prepare($sql);
        try{
            $stmt->bind_param('ii', $id_jugador, $partida);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado->free_result();
            return 'partidas ganadas incrementadas con exito';
        }catch  (Exception $exception) {
            return 'Error al incrementar las partidas ganadas del jugador de la base de datos : ('.$exception->getMessage().'). codigo de error: '.$exception->getCode().'.';
        }finally{
            self::desconectar(); 
        }
    }

}


