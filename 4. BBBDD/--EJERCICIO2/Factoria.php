<?php
require_once 'Partida.php';

class FactoriaPartida {
    public static function crearPartida($tamanio, $minas) { //si no se mete nada 10,2
        // Aquí puedes realizar lógica de inicialización adicional si es necesario
        // Por ejemplo, configurar el tablero de juego y colocar las minas

        // Crea una nueva instancia de Partida y devuelve
        return new Partida($tamanio, $minas);
    }
}