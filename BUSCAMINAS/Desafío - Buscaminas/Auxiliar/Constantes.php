<?php
//esta clase sirve para guardar las constantes de la conexion a la base de datos
class Constantes {
    static $headerMssg = "HTTP/1.1 "; //cabecera de mensaje
    static $host = '127.0.0.1'; //host de la base de datos
    static $user = 'root';//usuario de la base de datos
    static $psswd = '';//
    static $bdName = 'buscaminas_bbdd';//nombre de la base de datos
    const tamano_tablero_estandar = 10;
    const num_minas_estandar = 4;
    public static $tablaJugador = 'jugador';
    public static $tablaPartida = 'partida';

}
