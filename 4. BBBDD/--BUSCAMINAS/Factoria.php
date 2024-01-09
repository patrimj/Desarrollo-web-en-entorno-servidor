<?php

class Factoria { // la factoria es la que crea el objeto
    public static function generaBuscaminas($cant, $min) {
        return new Partida($cant, $min);
    }
}


