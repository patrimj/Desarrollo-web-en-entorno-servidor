<?php

require_once __DIR__.'..\Modelo\Jugador.php';
require_once __DIR__.'..\Modelo\Partida.php';
require_once __DIR__.'..\Auxiliar\Conexion.php';

class Factoria{
    public static function jugadorNuevo($id_jugador, $nombre, $email, $pssw, $partidas_jugadas, $partidas_ganadas, $administrador){ //crea un nuevo jugador
        return new Jugador($id_jugador, $nombre, $email, $pssw, $partidas_jugadas, $partidas_ganadas, $administrador);
    }
    public static function partidaNueva ($id_partida, $id_jugador, $tablero_oculto, $tablero_visible, $estado){ //crea una nueva partida
        return new Partida($id_partida, $id_jugador, $tablero_oculto, $tablero_visible, $estado);
    }
}